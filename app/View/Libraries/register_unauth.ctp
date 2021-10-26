 <style>
    
		.error::after {
        content:attr(data-errmsg);
        position: relative;
        margin-top:50px;

      };
		
	</style> 
 <?php
  echo $this->Form->create('RegisterLibrary',  
    array('id'=>'form',
    '@submit' => 'checkForm'
  ));
echo $this->Form->input('bot-field', array(
  'type' => 'text','id'=>'honeytrap','label'=>"Only if you are not a human",'name'=>'bot_field',"placeholder"=>"First Name", "v-bind:value"=>"formData.bot_field",
  'div' => array(
    'style' => 'display:none'
    )
));

echo $this->Form->input('first_name', array(
  'type' => 'text','id'=>'first_name','label'=>"First Name",'name'=>'first_name',"placeholder"=>"First Name", 
  "v-model:value"=>"formData.first_name",
  'div' => array(
        "data-errmsg"=>"error",
        'v-bind:class' => "{'error':!isfirst_nameValid}"
    )
));
echo $this->Form->input('last_name', array(
  'type' => 'text','id'=>'last_name','label'=>"Last Name",'name'=>'last_name',"placeholder"=>"Last Name", 
  "v-model:value"=>"formData.last_name",
   'div' => array(
        "data-errmsg"=>"error",
        'v-bind:class' => "{'error':!islast_nameValid}"
    )
));
echo $this->Form->input(
  'designation', array('type' => 'text','id'=>'designation','label'=>"Designation",'name'=>'designation',"placeholder"=>"Designation", "v-model:value"=>"formData.designation"
));
echo $this->Form->input('phone', array(
  'type' => 'text','id'=>'phone','label'=>"Phone",'name'=>'phone',"placeholder"=>"Phone", "v-model:value"=>"formData.phone"
));
echo $this->Form->input('email', array(
  'type' => 'text','id'=>'email','label'=>"Email",'name'=>'email',"placeholder"=>"Email", "v-model:value"=>"formData.email"
));
echo $this->Form->input('institute_name', array(
  'type' => 'text','id'=>'institute_name','label'=>"Institute Name",'name'=>'institute_name',"placeholder"=>"Institute Name", "v-model:value"=>"formData.institute_name"
));
echo $this->Form->input(
  'library_name', array('type' => 'text','id'=>'library_name','label'=>"Library name",'name'=>'library_name',"placeholder"=>"Library Name", "v-model:value"=>"formData.library_name"
));
echo $this->Form->input(
  'library_address', array('type' => 'text','id'=>'library_address','label'=>'Library Address','name'=>'library_address',"placeholder"=>"Library Address", "v-model:value"=>"formData.library_address"
));

?>



<?php
// echo $this->Form->input('token', array('type' => 'hidden','id'=>'token','label'=>false,'name'=> 'token'));
echo $this->Form->end('submit');
?>


<script>


function initMap(){
   var input = document.getElementById("library_address");
  var options = {
    fields: ["address_components", "geometry", "icon", "name"],
    strictBounds: false,
    types: ["establishment"],
  };
  var autocomplete = new google.maps.places.Autocomplete(input, options);

}
// function fillInAddress() {
//   // Get the place details from the autocomplete object.
//   const place = autocomplete.getPlace();
//   let address1 = "";
//   let postcode = "";

//   // Get each component of the address from the place details,
//   // and then fill-in the corresponding field on the form.
//   // place.address_components are google.maps.GeocoderAddressComponent objects
//   // which are documented at http://goo.gle/3l5i5Mr
//   for (const component of place.address_components) {
//     const componentType = component.types[0];

//     switch (componentType) {
//       case "street_number": {
//         address1 = `${component.long_name} ${address1}`;
//         break;
//       }

//       case "route": {
//         address1 += component.short_name;
//         break;
//       }

//       case "postal_code": {
//         postcode = `${component.long_name}${postcode}`;
//         break;
//       }

//       case "postal_code_suffix": {
//         postcode = `${postcode}-${component.long_name}`;
//         break;
//       }
//       case "locality":
//         document.querySelector("#locality").value = component.long_name;
//         break;
//       case "administrative_area_level_1": {
//         document.querySelector("#state").value = component.short_name;
//         break;
//       }
//       case "country":
//         document.querySelector("#country").value = component.long_name;
//         break;
//     }
//   }
// }

  // address1Field.value = address1;
  // postalField.value = postcode;


  var nameRegEx = /^[A-Za-z\/\s\.'-]+$/
  var emailRegEx = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i

  var app = new Vue({
  el: '#form',
  data: {
    formData:{
      bot_field:'',
      first_name:'',
      last_name:'',
      phone:'',
      email:'',
      institute_name:'',
      designation:'',
      library_name:'',
      library_address:'',
    },
    
 
  },

 
  computed:{
    isfirst_nameValid(){

      return nameRegEx.test(this.formData.first_name) || this.formData.first_name == ''

    },
    islast_nameValid(){
       return nameRegEx.test(this.formData.last_name)  || this.formData.last_name == ''
    },
    isPhoneValid(){
      return !isNaN(this.formData.phone) || this.formData.phone == ''
    },
    isEmailValid(){
      return emailRegEx.test(this.formData.email) || this.formData.email == ''
    },

  },
  
  methods:{
    
    checkForm(e){

      if (this.isfirst_nameValid && this.islast_nameValid && isPhoneValid && isEmailValid) {
        return true;
      }

      // // if (!this.name) {
      // //   this.errors.push('Name required.');
      // // }
      // // if (!this.age) {
      // //   this.errors.push('Age required.');
      // // }
      console.log('error')

      e.preventDefault();
    },
   
  }
})


</script>

                                   