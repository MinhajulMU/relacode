import React, { useState } from "react";
import { InertiaLink, usePage, useForm } from "@inertiajs/inertia-react";
import TextInput from "@/Shared/Form/TextInput";
import TextareaInput from "@/Shared/Form/TextareaInput";
import Select2 from "@/Shared/Form/Select2";
import Radio from "@/Shared/Form/Radio";
import SubmitButton from "@/Shared/Form/SubmitButton";
import DateInput from "@/Shared/Form/DateInput";
import FileInput from "@/Shared/Form/FileInput";

const Form = ({ data, setData, processing }) => {
  const props = usePage().props;
  return (
    <React.Fragment>
      <div className="container">
        <DateInput
          type="date"
          label="Date"
          name="date"
          errors={props.errors.date}
          value={data.date}
          onChange={(e, dateString) => setData("date", dateString)}
        />

        <TextInput
          type="text"
          label="File Name"
          name="file_name"
          errors={props.errors.file_name}
          value={data.file_name}
          onChange={(e) => setData("file_name", e.target.value)}
        />

        <TextInput
          type="text"
          label="File Path"
          name="file_path"
          errors={props.errors.file_path}
          value={data.file_path}
          onChange={(e) => setData("file_path", e.target.value)}
        />
        <div className="row">
          <div className="col-12 text-right">
            <InertiaLink href={props.routes.backUrl}>
              <button className="btn btn-secondary mr-1">Cancel</button>
            </InertiaLink>
            <SubmitButton
              name={props.backupDb != null ? "Update" : "Tambah"}
              isLoading={processing}
            ></SubmitButton>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export default Form;
