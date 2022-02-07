<?php
namespace Insyghts\Authendication\Services;
use Insyghts\Authendication\Models\Contact;

class ContactService{


    function __construct(Contact $contact) {

        $this->contact = $contact;
    }


      public function allContacts()
      {
        $Contact = new Contact();
        return  $resul = $this->contact->Contacts();

      }

      public function single($id)
      {
        $Contact = new Contact();
        return  $result = $this->contact->single($id);

      }

      public function store(array $input)
      {

        $Contact = new Contact();
        return  $result = $this->contact->store($input);

      }

      public function update(array $data , $id)
      {

        $Contact = new Contact();
        return  $result = $this->contact->ConttactUpdate($data , $id);

      }

      public function delete($id)
      {
        $Contact = new Contact();
        return  $result = $this->contact->delete_contact($id);

      }



}
