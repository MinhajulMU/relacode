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
          label="Name"
          name="name"
          errors={props.errors.name}
          value={data.name}
          onChange={(e) => setData("name", e.target.value)}
        />

        <TextInput
          type="email"
          label="Email"
          name="email"
          errors={props.errors.email}
          value={data.email}
          onChange={(e) => setData("email", e.target.value)}
        />

        <TextInput
          type="password"
          label="Password"
          name="password"
          errors={props.errors.password}
          disabled={typeof props.users !== 'undefined' ? true: false}
          value={data.password}
          onChange={(e) => setData("password", e.target.value)}
        />

        <Select2
          label="Role"
          name="id_role"
          errors={props.errors.id_role}
          data={props.ref_role}
          selected={data.id_role}
          isMulti="true"
          onChange={(selectedOption) =>
            setData("id_role", selectedOption)
          }
        ></Select2>
        <div className="row">
          <div className="col-12 text-right">
            <InertiaLink href={props.routes.backUrl}>
              <button className="btn btn-secondary mr-1">Cancel</button>
            </InertiaLink>
            <SubmitButton
              name={props.users != null ? "Update" : "Tambah"}
              isLoading={processing}
            ></SubmitButton>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export default Form;
