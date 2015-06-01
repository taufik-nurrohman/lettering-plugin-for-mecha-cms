<?php

// Cleaning up ...
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['fields']['break_title_text']['type']) && ( ! isset($_POST['fields']['break_title_text']['value']) || isset($_POST['fields']['break_title_text']['value']) && $_POST['fields']['break_title_text']['value'] === false)) {
        unset($_POST['fields']['break_title_text']);
    }
}