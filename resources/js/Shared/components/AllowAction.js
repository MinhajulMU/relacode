import React, { useState } from 'react';
import { InertiaLink, usePage } from "@inertiajs/inertia-react";

const AllowAction = ({module,action,children}) => {
    const props = usePage().props;
    const privileges = props.auth.role_privileges;
    let isAllow = false;
    if (privileges.hasOwnProperty(module)) {
        if (privileges[module].hasOwnProperty("can_"+action)) {
             isAllow = privileges[module]["can_"+action];
        }
    }
    return (
        <React.Fragment>
            {(isAllow == 1 && children)}
        </React.Fragment>
    )    
}
export default AllowAction;