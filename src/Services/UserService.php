<?php
namespace Insyghts\Authendication\Services;
use Insyghts\Authendication\Models\User;

class UserService{
    function __construct(User $user) {

        $this->user = $user;
    }

    public function login(array $input)
    {

      $Contact = new User();
      return  $result = $this->user->login($input);

    }

    public function refresh(array $input)
    {

      $Contact = new User();
      return  $result = $this->user->refresh_token($input);

    }



}
