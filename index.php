<?php
require_once __DIR__.'/vendor/autoload.php';
$pageId = 'home';
$pageTitle = 'Documentation';

if (!session_id()) @session_start();

$msg = new \Plasticbrain\FlashMessages\FlashMessages();

require 'header.php';
?>


    <div class="page-header">
        <h1>PHP Flash Messages</h1>
        <p>A modern take on session-based flash messages</p>
    </div>
    
    <div class="row-fluid">


        <div id="main" class="col-xs-9">

        <div class="sub-heading"><h3>Features</h3></div>
        <p>Store messages in session data until they are retrieved.  Featuring PSR-4 compliance, Bootstrap compatibility, sticky messages, and more. </p>
        <ul>
            <li>Namespaced</li>
            <li>PSR-4 autoload compliant</li>
            <li>Installable with composer</li>
            <li>Works with Bootstrap</li>
            <li>Fully customizable messages</li>
            <li>Sticky messages</li>
        </ul>

        <div class="sub-heading"><h3>Roadmap</h3></div>
        <ul>
            <li>Add custom message types</li>
            <li>Persistent messages (show message until it is manually cleared)</li>
        </ul>

        <div class="sub-heading"><h3>Installation</h3></div>
        
        <h4>With Composer</h4>
        <pre class="brush:bash">
        composer require plasticbrain/php-flash-messages
        </pre>

        <h4>Without Composer</h4>
        <p>Download <a href="https://raw.githubusercontent.com/plasticbrain/PhpFlashMessages/master/src/FlashMessages.php" target="_blank">FlashMessages.php</a> and save it to your project directory.</p>

        <p>Import the file:</p>
        <pre class="brush:php">
        require '/path/to/FlashMessages.php';
        </pre>

        <div class="sub-heading"><h3>Basic Usage</h3></div>


        <pre class="brush:php">
        &lt;?php
        
        // A session is required
        if (!session_id()) @session_start();

        // Instantiate the class
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();

        // Add a few messages
        $msg->info('This is an info message');
        $msg->success('This is a success message');
        $msg->warning('This is a warning message');
        $msg->error('This is an error message');

        // Display the messages
        $msg->display();
        </pre>

        <div class="sub-heading"><h3>Message Types</h3></div>

        <p>There are currently four different message types: <span class="text-info">information</span>, <span class="text-success">success</span>, <span class="text-warning">warning</span>, and <span class="text-danger">error</span>.</p>
        
        <h4>Success</h4>
        <pre class="brush:php;">
        $msg->success('This is a success message');   
        </pre>
        <?php
        $msg->success('This is a success message');
        $msg->display('success');
        ?>

        <h4>Info</h4>
        <pre class="brush:php">
        $msg->info('This is an info message');   
        </pre>
        <?php
        $msg->info('This is an info message');
        $msg->display('info');
        ?>

        <h4>Warning</h4>
        <pre class="brush:php">
        $msg->warning('This is a warning');   
        </pre>
        <?php
        $msg->warning('This is a warning');
        $msg->display('warning');
        ?>

        <h4>Error</h4>
        <pre class="brush:php">
        $msg->error('This is an error message');   
        </pre>
        <?php
        $msg->error('This is an error');
        $msg->display('error');
        ?>

        <h4>Message Constants</h4>
        <p>Each message type can be referred to by its constant: <code>INFO</code>, <code>SUCCESS</code>, <code>WARNING</code>, <code>ERROR</code>. For example:</p>
        <pre class="brush:php">
        $msg::INFO
        $msg::SUCCESS
        $msg::WARNING
        $msg::ERROR
        </pre>

        <div class="sub-heading"><h3>Redirects</h3></div>

        <p>You can redirect to a different URL before displaying the message by passing the URL as the 2nd parameter:</p>
        <pre class="brush:php">
        $msg->error('This is an error message', 'http://yoursite.com/another-page');
        </pre>
        
        <p>A redirect is executed as soon as the message it's attached to is queued. As such, if you need multiple messages AND need to redirect then include the URL with the last message:</p>
        <pre class="brush:php">
        $msg->success('This is a success message');
        $msg->success('This is another success message');
        $msg->error('This is an error message', 'http://redirect-url.com');   
        </pre>

        <p>You can also use one of the helper methods <code>hasErrors</code> or <code>hasMessages</code>:</p>
        <pre class="brush:php">
        // Check if there are any errors
        if ($msg->hasErrors()) {
            header('Location: redirect-url');
            exit();
        }

        // Check if there are any of a specific type of messages
        if ($msg->hasMessages($msg::INFO)) {
            ...
        }

        if ($msg->hasMessages($msg::SUCCESS)) {
            ...
        }

        // See if there are any types of messages at all
        if ($msg->hasMessages()) {
            ...
        }
        </pre>

        <div class="sub-heading"><h3>Sticky Messages</h3></div>

        <p>By default, all messages include a close button. The close button can be removed, thus making the message <em>sticky</em>. To make a message sticky pass <code>true</code> as the third parameter:</p>
        <pre class="brush:php">
        $msg->error("This is a sticky error message (it can't be closed)", null, true);
        $msg->warning("This is a sticky warning message (it can't be closed)", null, true);
        $msg->success("This is a sticky success message (it can't be closed)", null, true);
        $msg->info("This is a sticky info message (it can't be closed)", null, true);
        </pre>
        <?php
        $msg->error("This is a sticky error message (it can't be closed)", null, true);
        $msg->success("This is a sticky success message (it can't be closed)", null, true);
        $msg->info("This is a sticky info message (it can't be closed)", null, true);
        $msg->warning("This is a sticky warning message (it can't be closed)", null, true);
        $msg->display();
        ?>

        <p>There's also a special method, appropriately enough called <code>sticky()</code>, that can be used to make sticky messages:</p>

        <pre class="brush:php">
        $msg->sticky('This is also a sticky message');
        </pre>
        
        <p><code>sticky()</code> accepts an optional 2nd parameter for the redirect url, and a 3rd for the message type:</p>
        
        <pre class="brush:php">
        $msg->sticky('This is "success" sticky message', 'http://redirect-url.com', $msg::SUCCESS);
        </pre>

        <p>By default, <code>sticky()</code> will render as whatever the default message type is set to (usually <em>info</em>.) Use the 3rd parameter override this.</p>

        <div class="sub-heading"><h3>Helper Methods</h3></div>

        <h4 class="code">hasErrors()</h4>
        <p>Check to see if there are any queued <code>ERROR</code> messages.</p>
        <pre class="brush:php">
        if ($msg->hasErrors()) {
            // There are errors, so do something like redirect
        }
        </pre>

        <h4 class="code">hasMessages ( [string $type] )</h4>
        <p>Check to see if there are any specific message types (or any messages at all) queued.</p>
        <pre class="brush:php">
        // Check if there are any INFO messages
        if ($msg->hasMessages($msg::INFO)) {
            ...
        }

        // Check if there are any SUCCESS messages
        if ($msg->hasMessages($msg::SUCCESS)) {
            ...
        }

        // Check if there are any WARNING messages
        if ($msg->hasMessages($msg::WARNING)) {
            ...
        }

        // Check if there are any ERROR messages
        if ($msg->hasMessages($msg::ERROR)) {
            ...
        }

        // See if there are *any* messages queued at all
        if ($msg->hasMessages()) {
            ...
        }
        </pre>

        <h4 class="code">setCloseBtn ( string $html )</h4>
        <p>Sets the HTML for the close button that's displayed on (non-sticky) messages.</p>
        <pre class="brush:php">
        $msg->setCloseBtn('&lt;button type="button" class="close" 
                                data-dismiss="alert" 
                                aria-label="Close">
                                &lt;span aria-hidden="true">&amp;times;</span>
                            &lt;/button>')
        </pre>

        <h4 class="code">setCssClassMap ( array $cssClassMap )</h4>
        <p>Sets the CSS classes that are used for each specific message type.</p>
        <pre class="brush:php">
        $msg->setCssClassMap([
            $msg::INFO    => 'alert-info',
            $msg::SUCCESS => 'alert-success',
            $msg::WARNING => 'alert-warning',
            $msg::ERROR   => 'alert-danger',
        ]);
        </pre>

        <h4 class="code">setMsgAfter ( string $msgAfter )</h4>
        <p>Add a string of text (HTML or otherwise) <b>after</b> the message (but <b>inside</b> of the wrapper.)</p>
        <p>For example, wrap a message in <code>&lt;p></code> tags:</p>
        <pre class="brush:php">
        $msg->setMsgAfter('&lt;/p>')
        </pre>

        <h4 class="code">setMsgBefore ( string $msgBefore )</h4>
        <p>Add a string of text (HTML or otherwise) <b>before</b> the message (but <b>inside</b> of the wrapper.)</p>
        <p>For example, wrap a message in <code>&lt;p></code> tags:</p>
        <pre class="brush:php">
        $msg->setMsgBefore('&lt;p>')
        </pre>

        <h4 class="code">setMsgCssClass ( [string $cssClass] )</h4>
        <p>Sets the CSS class that is applied to all messages, regardless of their type.</p>
        <pre class="brush:php">
        $msg->setMsgCssClass('alert')
        </pre>

        <h4 class="code">setMsgWrapper ( string $html )</h4>
        <p>Sets the HTML that wraps each message. HTML should include two placeholders (<code>%s</code>) for the CSS class and message text.</p>
        <pre class="brush:php">
        $msg->setMsgWrapper("&lt;div class='%s'>%s&lt;/div>")
        </pre>

        <h4 class="code">setStickyCssClass ( [string $cssClass] )</h4>
        <p>Set the CSS class used for sticky messages</p>
        <pre class="brush:php">
        $msg->setStickyCssClass('sticky')
        </pre>

        </div>

        <div class="col-xs-3">
            <div id="sidebar" data-spy="affix" data-offset-top="100">
                <div id="toc"></div>
            </div>
        </div>
        

    </div>


<?php require 'footer.php'; ?>