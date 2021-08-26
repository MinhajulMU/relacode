<?php

function currentRole(){
    return session()->get('active_role');
}

function changeRole($role){
    return session()->put('active_role', $role);
}

function allowAccess($moduleSlug, $action){
    return session()->get('role_privileges')[$moduleSlug]['can_'.strtolower($action)] ?? false;
}
