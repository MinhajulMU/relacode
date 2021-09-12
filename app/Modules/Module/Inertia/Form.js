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
          label="Nama Module"
          name="name"
          errors={props.errors.name}
          value={data.name}
          onChange={(e) => setData("name", e.target.value)}
        />


        <Select2
          label="Grup Menu"
          name="id_menu_grup"
          errors={props.errors.id_menu_grup}
          data={props.ref_menu_grup}
          selected={data.id_menu_grup}
          onChange={(selectedOption) =>
            setData("id_menu_grup", selectedOption.value)
          }
        ></Select2>
        <TextInput
          type="number"
          label="Urutan"
          name="urutan"
          min="0"
          errors={props.errors.urutan}
          value={data.urutan}
          onChange={(e) => setData("urutan", e.target.value)}
        />
        <div className={`form-group ${props.errors.length ? "has-error" : ""}`}>
          <div className="row">
            <div className="col-8">
              <label htmlFor="icon">Icon</label>
            </div>
            <div className="col-4 text-right">
             <b> Preview: </b> <i className={data.icon}></i>
            </div>
          </div>

          <input
            type="text"
            className="form-control"
            value={data.icon}
            onChange={(e) => setData("icon", e.target.value)}
          />
          {props.errors.icon && (
            <div className="form-text text-muted text-danger">
             {props.errors.icon}
            </div>
          )}
        </div>
        <TextInput
          type="text"
          label="Slug"
          name="slug"
          errors={props.errors.slug}
          value={data.slug}
          onChange={(e) => setData("slug", e.target.value)}
        />
        <Radio
          label="Is Show"
          name="is_show"
          errors={props.errors.is_show}
          value={data.is_show}
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
          onChange={(e) => setData("is_show", e.target.value)}
        ></Radio>

        <div className="row">
          <div className="col-12 text-right">
            <InertiaLink href={props.routes.backUrl}>
              <button className="btn btn-secondary mr-1">Cancel</button>
            </InertiaLink>
            <SubmitButton
              name={props.module != null ? "Update" : "Tambah"}
              isLoading={processing}
            ></SubmitButton>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export default Form;
