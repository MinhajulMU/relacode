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
                label="Title"
                name="title"
                errors={props.errors.title}
                value={data.title}
                onChange={e => setData("title", e.target.value)}
            />

 <TextareaInput
                    label="Description"
                    name="description"
                    errors={props.errors.description}
                    value={data.description}
                    onChange={e => setData("description", e.target.value)}
                />

<Select2
                    label="Author2"
                    name="id_author2"
                    errors={props.errors.id_author2}
                    data={props.ref_author2}
                    selected={data.id_author2}
                    onChange={selectedOption =>
                    setData("id_author2", selectedOption.value)
                    }
                ></Select2>

<Radio
                    label="Allow Pinjam"
                    name="allow_pinjam"
                    errors={props.errors.allow_pinjam}
                    value={data.allow_pinjam}
                    choises={[
                    {
                        key: 0,
                        value: "Tidak",
                    },
                    {
                        key: 1,
                        value: "Ya",
                    },
                    ]}
                    onChange={(e) => setData("allow_pinjam", e.target.value)}
                ></Radio>

<DateInput
                    type="date"
                    label="Tanggal Pinjam"
                    name="tanggal_pinjam"
                    errors={props.errors.tanggal_pinjam}
                    value={data.tanggal_pinjam}
                    onChange={(e,dateString) => setData("tanggal_pinjam", dateString)}
                    />
        <div className="row">
          <div className="col-12 text-right">
            <InertiaLink href={props.routes.backUrl}>
              <button className="btn btn-secondary mr-1">Cancel</button>
            </InertiaLink>
            <SubmitButton name={props.book2 != null ? "Update" : "Tambah"} isLoading={processing}></SubmitButton>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export default Form;
