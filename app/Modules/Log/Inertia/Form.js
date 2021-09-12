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
        <Select2
                    label="User"
                    name="id_user"
                    errors={props.errors.id_user}
                    data={props.ref_users}
                    selected={data.id_user}
                    onChange={selectedOption =>
                    setData("id_user", selectedOption.value)
                    }
                ></Select2>

 <TextInput
                type="text"
                label="Aktifitas"
                name="aktifitas"
                errors={props.errors.aktifitas}
                value={data.aktifitas}
                onChange={e => setData("aktifitas", e.target.value)}
            />
        <div className="row">
          <div className="col-12 text-right">
            <InertiaLink href={props.routes.backUrl}>
              <button className="btn btn-secondary mr-1">Cancel</button>
            </InertiaLink>
            <SubmitButton name={props.log != null ? "Update" : "Tambah"} isLoading={processing}></SubmitButton>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export default Form;
