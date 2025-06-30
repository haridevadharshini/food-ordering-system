<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model {

    public function save_message($data) {
        return $this->db->insert('contact_messages', $data);
    }

    public function getMessages() {
	return $this->db->order_by('created_at', 'DESC')->get('contact_messages')->result();
}


// Get only approved messages (public site)
public function getApprovedMessages() {
    return $this->db
        ->where('status', 'approved')
        ->order_by('id', 'DESC')
        ->get('contact_messages')
        ->result();
}


// Approve a message
public function approveMessage($id) {
    return $this->db->update('contact_messages', ['status' => 'approved'], ['id' => $id]);
}

// Delete a message
public function deleteMessage($id) {
    return $this->db->delete('contact_messages', ['id' => $id]);
}

}
