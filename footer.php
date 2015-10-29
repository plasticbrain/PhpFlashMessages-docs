    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/toc.min.js"></script>
    
    <script type="text/javascript" src="assets/js/shCore.js"></script>
    <script type="text/javascript" src="assets/js/shBrushPhp.js"></script>
    <script type="text/javascript" src="assets/js/shBrushCss.js"></script>
    <script type="text/javascript" src="assets/js/shBrushBash.js"></script>

    <script type="text/javascript">
    SyntaxHighlighter.defaults['toolbar'] = false;
    SyntaxHighlighter.all()


    $('#toc').toc({
        'selectors': 'h3,h4',
        'container': '#main',
        'smoothScrolling': true,
        'prefix': 'toc', 
        'anchorName': function(i, heading, prefix) {
            return heading.textContent.replace(/ /g, '-').toLowerCase();
        }
    });

    </script>

</body>
</html>