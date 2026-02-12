<script>
    // Disable Right Click
    document.addEventListener('contextmenu', event => event.preventDefault());

    // Disable Shortcuts for DevTools
    document.onkeydown = function (e) {
        if (e.keyCode == 123) { // F12
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) { // Ctrl+Shift+I
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) { // Ctrl+Shift+J
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) { // Ctrl+U
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) { // Ctrl+Shift+C
            return false;
        }
    }

    // Disable Selection
    document.onselectstart = function () {
        return false;
    }

    // Obfuscation Warning
    console.log("%cSTOP!", "color: red; font-size: 50px; font-weight: bold; text-shadow: 2px 2px 0px black;");
    console.log("%cThis is a protected area. Access to developer tools has been logged and reported.", "font-size: 20px;");
</script>