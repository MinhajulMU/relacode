import React, { useState } from 'react';
import { Button, Modal } from 'react-bootstrap';

const DeleteModal = ({show,handleCloseDeleteModal,handleDeleteAction}) => {
  return (
    <React.Fragment>
      <Modal show={show} onHide={() => {handleCloseDeleteModal}}>
        <Modal.Header closeButton>
          <Modal.Title>Konfirmasi</Modal.Title>
        </Modal.Header>
        <Modal.Body>Apakah anda yakin akan menghapus data ini ?</Modal.Body>
        <Modal.Footer>
          <button
            className="btn btn-secondary btn-sm"
            onClick={handleCloseDeleteModal}
          >
            Cancel
          </button>
          <button
            className="btn btn-danger btn-sm"
            id="delete-button"
            url=""
            onClick={handleDeleteAction}
          >
            Delete
          </button>
        </Modal.Footer>
      </Modal>
    </React.Fragment>
  );
};

export default DeleteModal;
