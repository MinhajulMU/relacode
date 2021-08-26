import React, { useState } from 'react';
import { InertiaLink, usePage, useForm } from '@inertiajs/inertia-react';
import TextInput from '@/Shared/Form/TextInput';
import TextareaInput from '@/Shared/Form/TextareaInput';
import Select2 from '@/Shared/Form/Select2';
import Radio from '@/Shared/Form/Radio';
import SubmitButton from '@/Shared/Form/SubmitButton';

const Form = ({data,setData,processing}) => {
  const props = usePage().props;
  return (
    <React.Fragment>
      <div className="container">
        <Select2
          label="Author"
          name="id_author"
          errors={props.errors.id_author}
          data={props.ref_author}
          selected={data.id_author}
          onChange={selectedOption =>
            setData('id_author', selectedOption.value)
          }
        ></Select2>
        <Radio
          label="Allow Pinjam"
          name="allow_pinjam"
          errors={props.errors.allow_pinjam}
          value={data.allow_pinjam}
          choises={props.ref_allow_pinjam}
          onChange={e => setData('allow_pinjam', e.target.value)}
        ></Radio>
        <TextInput
          type="text"
          label="Title"
          name="title"
          errors={props.errors.title}
          value={data.title}
          placeholder="Enter Title"
          onChange={e => setData('title', e.target.value)}
        />
        <TextareaInput
          label="Description"
          name="description"
          errors={props.errors.description}
          value={data.description}
          onChange={e => setData('description', e.target.value)}
        />
        <div className="row">
          <div className="col-12 text-right">
            <InertiaLink href={props.routes.backUrl}>
              <button className="btn btn-secondary mr-1">Cancel</button>
            </InertiaLink>
            <SubmitButton name={props.book != null ? "Update" : "Tambah"} isLoading={processing}></SubmitButton>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export default Form;
