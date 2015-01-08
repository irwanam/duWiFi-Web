<?php
    require_once '../core/AddressTable.php';
    
    class Address extends Member
    {
        public $idmember;
        public $idaddress;
        public $address;
        public $village;
        public $district;
        public $city;
        public $postal_code;
        public $phone;
        public $last_update;


        
        public function __construct()
        {

        }
        
        public function exchangeArray($data)
        {
            $this->idmember     = (isset($data['idmember'])) ? $data['idmember'] : null;
            $this->idaddress    = (isset($data['idaddress'])) ? $data['idaddress'] : null;
            $this->address      = (isset($data['address'])) ? $data['address'] : null;
            $this->village      = (isset($data['village'])) ? $data['village'] : null;
            $this->district     = (isset($data['district'])) ? $data['district'] : null;
            $this->city         = (isset($data['city'])) ? $data['city'] : null;
            $this->postal_code  = (isset($data['postal_code'])) ? $data['postal_code'] : null;
            $this->phone        = (isset($data['phone'])) ? $data['phone'] : null;
            
            return $this;
        }
        
        public function getAddress($addressid)
        {
            $db = new AddressTable();
            $address = $db->getData('address',$addressid);
            return $address;
        }

        public function saveAddress($data)
        {
            $addressData = array(
                'idmember'      => $data->idmember,
                'idaddress'     => $data->idaddress,
                'address'       => $data->address,
                'village'       => $data->village,
                'district'      => $data->district,
                'city'          => $data->city,
                'postal_code'   => $data->postal_code,
                'phone'         => $data->phone,
                );
            
            $addressTable = new AddressTable();
            if(empty($data->idaddress)){
                $addressTable->insertAddress($addressData);
                $arr = array(
                    'success' => 'true',
                    'action' => 'add address',
                    'member' => $data->idmember,
                    'address' => $data->idaddress
                        );
            } else {
                $addressTable->updateAddress($addressData);
                $arr = array(
                    'success' => 'true',
                    'action' => 'save address',
                    'member' => $data->idmember,
                    'address' => $data->idaddress,
                        );
            }
            return $arr;

        }
    }
?>