import React, { useState } from 'react';
import { InertiaLink, usePage, useForm } from '@inertiajs/inertia-react';
import TextInput from '@/Shared/Form/TextInput';
import TextareaInput from '@/Shared/Form/TextareaInput';
import Select2 from '@/Shared/Form/Select2';
import Radio from '@/Shared/Form/Radio';
import SubmitButton from '@/Shared/Form/SubmitButton';
import DateInput from "@/Shared/Form/DateInput";

const Form = ({data,setData,processing}) => {
  const props = usePage().props;
  return (
    <React.Fragment>
      <div className="container">
         <TextInput
                type="number"
                label="Can Create"
                name="can_create"
                errors={props.errors.can_create}
                value={data.can_create}
                onChange={e => setData("can_create", e.target.value)}
            />

 <TextInput
                type="number"
                label="Can Delete"
                name="can_delete"
                errors={props.errors.can_delete}
                value={data.can_delete}
                onChange={e => setData("can_delete", e.target.value)}
            />

 <TextInput
                type="number"
                label="Can Read"
                name="can_read"
                errors={props.errors.can_read}
                value={data.can_read}
                onChange={e => setData("can_read", e.target.value)}
            />

 <TextInput
                type="number"
                label="Can Update"
                name="can_update"
                errors={props.errors.can_update}
                value={data.can_update}
                onChange={e => setData("can_update", e.target.value)}
            />

 <TextInput
                type="number"
                label="Can Validate"
                name="can_validate"
                errors={props.errors.can_validate}
                value={data.can_validate}
                onChange={e => setData("can_validate", e.target.value)}
            />

<Select2
                    label="Module"
                    name="id_module"
                    errors={props.errors.id_module}
                    data={props.ref_module}
                    selected={data.id_module}
                    onChange={selectedOption =>
                    setData("id_module", selectedOption.value)
                    }
                ></Select2>

<Select2
                    label="Role"
                    name="id_role"
                    errors={props.errors.id_role}
                    data={props.ref_role}
                    selected={data.id_role}
                    onChange={selectedOption =>
                    setData("id_role", selectedOption.value)
                    }
                ></Select2>
        <div className="row">
          <div className="col-12 text-right">
            <InertiaLink href={props.routes.backUrl}>
              <button className="btn btn-secondary mr-1">Cancel</button>
            </InertiaLink>
            <SubmitButton name={props.rolePrivilege != null ? "Update" : "Tambah"} isLoading={processing}></SubmitButton>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export default Form;
