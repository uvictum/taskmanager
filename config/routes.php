<?php
return array(
        "'^((\/)|(\/\?page=[0-9]{1,4})){1}$'" => "home/display",
        "'^(\/\?order_type=[0-3]{1})$'" => "home/sort",
        "'\/logout'" => "login/logout",
        "'\/login'" => "login/signin",
        "'\/newtask'" => "editor/newtask",
        "'\/preview'" => "editor/preview");