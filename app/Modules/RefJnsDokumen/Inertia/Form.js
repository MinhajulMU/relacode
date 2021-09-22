import React, { useState } from "react";
import { InertiaLink, usePage, useForm } from "@inertiajs/inertia-react";
import TextInput from "@/Shared/Form/TextInput";
import TextareaInput from "@/Shared/Form/TextareaInput";
import Select2 from "@/Shared/Form/Select2";
import Radio from "@/Shared/Form/Radio";
import SubmitButton from "@/Shared/Form/SubmitButton";
import DateInput from "@/Shared/Form/DateInput";

const Form = ({ data, setData, processing }) => {
  const props = usePage().props;
  return (
    <React.Fragment>
      <div className="container">
        <TextInput
          type="text"
          label="Nama Jenis Dokumen"
          name="nm_jns_dokumen"
          errors={props.errors.nm_jns_dokumen}
          value={data.nm_jns_dokumen}
          onChange={(e) => setData("nm_jns_dokumen", e.target.value)}
        />
        <div className="row">
          <div className="col-12 text-right">
            <InertiaLink href={props.routes.backUrl}>
              <button className="btn btn-secondary mr-1">Cancel</button>
            </InertiaLink>
            <SubmitButton
              name={props.refJnsDokumen != null ? "Update" : "Tambah"}
              isLoading={processing}
            ></SubmitButton>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export default Form;
