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
                type="text"
                label="Key"
                name="key"
                errors={props.errors.key}
                value={data.key}
                onChange={e => setData("key", e.target.value)}
            />

 <TextInput
                type="text"
                label="Value"
                name="value"
                errors={props.errors.value}
                value={data.value}
                onChange={e => setData("value", e.target.value)}
            />
        <div className="row">
          <div className="col-12 text-right">
            <InertiaLink href={props.routes.backUrl}>
              <button className="btn btn-secondary mr-1">Cancel</button>
            </InertiaLink>
            <SubmitButton name={props.config != null ? "Update" : "Tambah"} isLoading={processing}></SubmitButton>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export default Form;
