<?php
    require_once '../core/Database.php';
    require_once '../core/TableGateway.php';
    require_once '../core/Member.php';
    
    class AddressTable extends MemberTable
    {
        function __construct(){
        
        }
        
        public function insertAddress($data)
        {
            $con = new Database();
            $member = new Member();
            $db = $con->connect();
            $sth = $db->prepare("INSERT INTO address (address,village,district,city,postal_code,phone) VALUES (:address,:village,:district,:city,:postal_code,:phone)");
            $sth->bindParam(':address',$data['address'],PDO::PARAM_STR);
            $sth->bindParam(':village',$data['village'],PDO::PARAM_STR);
            $sth->bindParam(':district',$data['district'],PDO::PARAM_STR);
            $sth->bindParam(':city',$data['city'],PDO::PARAM_STR);
            $sth->bindParam(':postal_code',$data['postal_code'],PDO::PARAM_STR);
            $sth->bindParam(':phone',$data['phone'],PDO::PARAM_STR);
            $sth->execute();
            $addressID= $db->lastInsertId();
            $currentMember = $member->getMember($data['idmember']);
            $memberAdddress = array(
                'id'            => $data['idmember'],
                'first_name'    => $currentMember['first_name'],
                'last_name'     => $currentMember['last_name'],
                'email'         => $currentMember['email'],
                'password'      => $currentMember['password'],
                'handphone'     => $currentMember['handphone'],
                'address'       => $addressID,
                'avatar'        => $currentMember['avatar'],
                'sex'           => $currentMember['sex'],
                'dob'           => $currentMember['dob']
            );
            $member->saveMember($member->exchangeArray($memberAdddress));
        }
        
        public function updateAddress($data)
        {
            $con = new Database();
            $db = $con->connect();
            $sth = $db->prepare("UPDATE address SET address=:address, village=:village, district=:district, city=:city, postal_code=:postal_code, phone=:phone, last_update=now() WHERE id=:id");
            $sth->bindParam(':id',$data['idaddress'],PDO::PARAM_INT);
            $sth->bindParam(':address',$data['address'],PDO::PARAM_STR);
            $sth->bindParam(':village',$data['village'],PDO::PARAM_STR);
            $sth->bindParam(':district',$data['district'],PDO::PARAM_STR);
            $sth->bindParam(':city',$data['city'],PDO::PARAM_STR);
            $sth->bindParam(':postal_code',$data['postal_code'],PDO::PARAM_STR);
            $sth->bindParam(':phone',$data['phone'],PDO::PARAM_STR);
            $sth->execute();
        }
    }
?>