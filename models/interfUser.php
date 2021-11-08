<?php


interface interfUser
{
    function getusername();
    function getemail();
    function getpassword();
    function getrank();
    function getid();

    function setusername($username);
    function setemail($email);
    function setpassword($password);
    function setrank($rank);
}