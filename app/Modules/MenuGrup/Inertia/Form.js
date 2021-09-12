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
                label="Nama Menu Grup"
                name="nm_menu_grup"
                errors={props.errors.nm_menu_grup}
                value={data.nm_menu_grup}
                onChange={e => setData("nm_menu_grup", e.target.value)}
            />

 <TextInput
                type="text"
                label="Icon"
                name="icon"
                errors={props.errors.icon}
                value={data.icon}
                onChange={e => setData("icon", e.target.value)}
            />

 <TextInput
                type="number"
                label="Urutan"
                name="urutan"
                errors={props.errors.urutan}
                value={data.urutan}
                onChange={e => setData("urutan", e.target.value)}
            />
        <div className="row">
          <div className="col-12 text-right">
            <InertiaLink href={props.routes.backUrl}>
              <button className="btn btn-secondary mr-1">Cancel</button>
            </InertiaLink>
            <SubmitButton name={props.menuGrup != null ? "Update" : "Tambah"} isLoading={processing}></SubmitButton>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export default Form;
