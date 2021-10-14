<?php

function getInstance(){
    return session('instance_selected');
}

function getInstanceName(){
    return getInstance()['name'];
}
