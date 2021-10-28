<?php
App::uses('CakeEmail', 'Network/Email');
class LibrariesController extends AppController {

   

    public $components = array('Session');

    
    protected function sendEmail($to, $subject, $template, $viewVars){

        $send_email = new CakeEmail();
        $send_email->from(array('info@bestbookbuddies.com' => 'BestBookBuddies'))
            ->to($to)
            ->subject($subject)
            ->emailFormat('html')
            ->template($template)
            ->viewVars($viewVars)
            ->send();
    }
    public function index(){

    }
    public function validate_email(){
        $this->layout = 'default';
         if($this->request->is('get')){
            $this->loadModel('Library');
            $token=$this->request->query('token');
           

            $token_row = $this->Library->find('first', array('conditions' => array('token' => $token) ));
            if($token_row){
                $isEmailVerified=$token_row['Library']['email_verified'];
                if($token_row['Library']['email_verified']){

                    $this->Flash->set("You have already verified this email");

                }else{
                    $this->Library->updateAll(array("email_verified" => true), array("token" => $token));
                    $email = $token_row['Library']['email'];
                    $fname = $token_row['Library']['first_name'];

                    $this->sendEmail(
                        $email, 
                        'Email address verified', 
                        'registerverified', 
                        ['fname' => $fname,'email' => $email]
                    );
                    $this->Flash->success("Thank you for verifying your email");
                }
            }else{
                 $this->Flash->set("Invalid token");
            }
         }
    }
    public function register_unauth(){

      

        $columns = array_keys($this->Library->schema());
        $fields = array();
        foreach ( $columns as $key) {
           $fields[$key] = array();
           if(isset($this->request->data[$key]) ){
            $fields[$key] = $this->request->data[$key];
           };
        } 
        $this->set('fields', $fields);

        $this->layout = 'register';
        if($this->request->is('post')){
            $token = bin2hex(openssl_random_pseudo_bytes(16));
            echo $this->request->data['bot_field'];
            if($this->request->data['bot_field'] != ''){
                 $this->Flash->set("Bot detected");
                 return;

            }

            $this->Library->create();

            $row = $this->Library->find('first', array('conditions' => array('email' => $this->request->data['email']) ));
            if($row){
                $this->Flash->success("This email address is already registered");
                $this->redirect('index');
            }

            $this->request->data['token'] = $token;
            if($this->Library->save($this->request->data)){

                
                $fname=$this->request->data['first_name'];
                $email=$this->request->data['email'];
       
                //Send notif to admin
                 $this->sendEmail(
                    'info@bestbookbuddies.com', 
                    'New Library Registration', 
                    'register', 
                    $this->request->data
                );


                //Send validation email to user
                $this->sendEmail(
                    $email, 
                    'Library Registration Request Received. Please verify details.', 
                    'otp', 
                    ['fname' => $fname,'token'=>$token]
                );
                $success_message = "Please verify your email address by clicking on the verification link sent to $email
                Please check the spam folder if you can't find it.";

                $this->Flash->success(__($success_message));
                $this->redirect('index');
        };
       }
    }
}
?>