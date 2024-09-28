<?php

function construct()
{
    //    echo "Dùng chung, load đầu tiên";
    load_model('index');
}
function indexAction()
{
    load_view('index');
}


///////////////////////////////////////////////////////////////////////////////  add 
function addAction() {
    load_view('add');
}



