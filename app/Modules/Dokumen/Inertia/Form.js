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
                label="Deskripsi"
                name="deskripsi"
                errors={props.errors.deskripsi}
                value={data.deskripsi}
                onChange={e => setData("deskripsi", e.target.value)}
            />

 <TextInput
                type="text"
                label="File Name"
                name="file_name"
                errors={props.errors.file_name}
                value={data.file_name}
                onChange={e => setData("file_name", e.target.value)}
            />

 <TextInput
                type="text"
                label="File Path"
                name="file_path"
                errors={props.errors.file_path}
                value={data.file_path}
                onChange={e => setData("file_path", e.target.value)}
            />

 <TextInput
                type="text"
                label="File Size"
                name="file_size"
                errors={props.errors.file_size}
                value={data.file_size}
                onChange={e => setData("file_size", e.target.value)}
            />

 <TextInput
                type="text"
                label="File Type"
                name="file_type"
                errors={props.errors.file_type}
                value={data.file_type}
                onChange={e => setData("file_type", e.target.value)}
            />

 <TextInput
                type="text"
                label="Jns Dokumen"
                name="id_jns_dokumen"
                errors={props.errors.id_jns_dokumen}
                value={data.id_jns_dokumen}
                onChange={e => setData("id_jns_dokumen", e.target.value)}
            />

 <TextInput
                type="text"
                label="Model"
                name="id_model"
                errors={props.errors.id_model}
                value={data.id_model}
                onChange={e => setData("id_model", e.target.value)}
            />

 <TextInput
                type="text"
                label="Model"
                name="model"
                errors={props.errors.model}
                value={data.model}
                onChange={e => setData("model", e.target.value)}
            />
        <div className="row">
          <div className="col-12 text-right">
            <InertiaLink href={props.routes.backUrl}>
              <button className="btn btn-secondary mr-1">Cancel</button>
            </InertiaLink>
            <SubmitButton name={props.dokumen != null ? "Update" : "Tambah"} isLoading={processing}></SubmitButton>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export default Form;
