<?php
$access_token = "TEST-3512230105254367-121621-bc8e603352e37bbf319fa1bb90b1a33c-570416670";

// Agrega credenciales
MercadoPago\SDK::setAccessToken($access_token);
$info = json_decode($this->input->raw_input_stream);

if (isset($info->type)) {
    switch ($info->type) {
        case 'mp-connect':
            // Desvinculo de mi sistema cuando el usuario desautoriza la app desde su cuenta de Mercadopago.
            if ($info->action == 'application.deauthorized') {

                $data_update = array(
                    'mp_access_token' => NULL,
                    'mp_public_key' => NULL,
                    'mp_refresh_token' => NULL,
                    'mp_user_id' => NULL,
                    'mp_expires_in' => NULL,
                    'mp_status' => 0
                );

                $this->producers->update_mp_connect($data_update, $info->user_id);
                $this->output->set_status_header(200);
                return;
            }

            // Pueden tomar otra acción si el $info->action = 'application.authrized'
            break;

        case 'payment':
            // Actualizo la información de pago recibida.
            $or_collection_id = $info->data->id;
            $info = MercadoPago\Payment::find_by_id($or_collection_id);
            $or_number = $info->external_reference;

            $data_update = array(
                'or_collection_status' => $info->status,
                'or_collection_status_detail' => $info->status_detail,
                'or_payment_type' => $info->payment_type_id,
                'or_payment_method' => $info->payment_method_id,
                'or_status' => gcfg($info->status,'or_status_collection_status')
            );

            $this->cart->update_ipn_order($data_update,$or_number);

            break;

        default:
            $this->output->set_status_header(200);
            return;
            break;
    }
}
$this->output->set_status_header(200);