 <style>
    
		.error::after {
        content:attr(data-errmsg);
        position: relative;
        margin-top:50px;

      };
  
   
      input:disabled{
        cursor: not-allowed !important;
        pointer-events: none  !important;
        color: #c0c0c0  !important;
        background: #ffffff !important;

      }
		
	</style> 

<?php
  function validateField($view, $fieldname){
    if(isset($view->validationErrors['Library'][$fieldname])){
      echo $view->validationErrors['Library'][$fieldname][0];
    }
    echo "";
  }
  echo $this->Form->create('RegisterLibrary', array('id'=>'form','@submit' => 'checkForm'));
   
?>
<div v-show="fullPage || step === 0">
  <text-input 
    label="Only if you are not a human" 
    name="bot_field" 
    v-model="formData.bot_field"
   
  
    style="display:none;">
  </text-input>
  <text-input 
    label="First Name" 
    name="first_name" 
    v-model="formData.first_name"
    ref="first_name"
    required
    error = "<?php validateField($this, "first_name")?>"
    :validators="[
      {
        rule:rules.name,
        error:'Please enter a valid first name'
      }
    ]"
  >
  </text-input>

  <text-input 
    label="Last Name" 
    name="last_name" 
    ref="last_name" 
    required
    error = "<?php validateField($this, "last_name")?>"

    v-model="formData.last_name"
    :validators="[
    {
      rule:rules.name,
      error:'Please enter a valid last name'
    }]"
    >
  </text-input>

   <text-input 
    label="Designation" 
    name="designation" 
    ref="designation" 
    required
    error = "<?php validateField($this, "designation")?>"
    v-model="formData.designation"
   :validators="[
    {
      rule:rules.name,
      error:'Please enter a valid desgnation'
    }]"
  >
  </text-input>

  <text-input 
    label="Institute Name" 
    name="institute_name" 
    ref="institute_name" 
    required
    error = "<?php validateField($this, "institute_name")?>"
    v-model="formData.institute_name"
    :validators="[
    {
      rule:rules.name,
      error:'Please enter a vald institute name'
    }]"
   >
  </text-input>

  <text-input 
    label="Phone" 
    name="phone" 
    ref="phone" 
    required
    error = "<?php validateField($this, "phone")?>"
    v-model="formData.phone"
    :validators="[
    {
      rule:rules.phone,
      error:'Please enter a valid phone number'
    }]"
    >
  </text-input>

  <text-input 
    label="Email" 
    name="email" 
    ref="email" 
    required
    error = "<?php validateField($this, "email")?>" 
    v-model="formData.email"
    :validators="[
    {
      rule:rules.email,
      error:'Please enter a valid phone number'
    }]"
    >
  </text-input>


  <div class="next">
    <input type="button" v-on:click="step++" value="Next" :disabled="!validate1()"></input>
</div>

</div>


<div v-show="fullPage || step === 1">
 
   <div class="input text">
      <label for="location">Search and autofill library info</label>
      <input name="location" id="location" placeholder="Search" type="text">
    </div>

    
  <text-input 
    label="Library name" 
    name="library_name" 
    ref="library_name" 
    required
    error = "<?php validateField($this, "library_name")?>"
    v-model="formData.library_name"
    :validators="[
    {
      rule:rules.name,
      error:'Please enter a valid name'
    }]">
  </text-input>
    <text-input 
      label="Library Address" 
      name="library_address" 
      ref="library_address" 
      required
      error = "<?php validateField($this, "library_address")?>"
      v-model="formData.library_address"
      :validators="[]">
    </text-input>

   <text-input 
    label="Country" 
    name="country" 
    ref="country"
    required
    error = "<?php validateField($this, "country")?>"
    v-model="formData.country"
    :validators="[
    {
      rule:rules.name,
      error:'Please enter a valid country name'
    }]">
  </text-input>
   <text-input 
    label="State" 
    name="state" 
    ref="state"
    required
    error = "<?php validateField($this, "state")?>"
    v-model="formData.state"
    :validators="[]">
  </text-input>
   <text-input 
    label="City" 
    name="city" 
    ref="city"
    required
    error = "<?php validateField($this, "city")?>"
    v-model="formData.city"
    :validators="[]">
  </text-input>
   <text-input 
    label="Pincode" 
    name="pincode" 
    ref="pincode"
    required
    error = "<?php validateField($this, "pincode")?>"
    v-model="formData.pincode"
    :validators="[]">
  </text-input>
  <?php echo $this->Form->end(
    array("label" =>"Submit",  ":disabled" => "!validate2()")); ?>

</div>
<script>

   function initMap(){
      var input = document.getElementById("location");
      var options = {
        fields: ["formatted_address", "address_components", "name"],
        strictBounds: false,
        types: ["establishment"],
      };
      var autocomplete = new google.maps.places.Autocomplete(input, options);
      autocomplete.addListener("place_changed", ()=>{app.fillInAddress(autocomplete)});
    }
  Vue.component('text-input', {
    inheritAttrs: false,
    props:['name', 'placeholder', 'label', 'value', 'validators', 'error'],
    data(){
      return{
        errorMsg:this.error
      }
    },
    computed:{
       isValid(){
        return  (this.errorMsg && this.errorMsg != '')
      },
     
    },
    methods:{
      valueUpdated(e){
        this.errorMsg = "";
        this.validate(e.target.value);
        this.$emit('input', e.target.value);
      },
      validate(value){
        for(let i in this.validators){
          if(!this.validators[i].rule(value)){
            this.errorMsg = this.validators[i].error
            break;
          }
        }
      }
    },
    template: `
   
      <div class="input text"
      :data-errmsg="errorMsg"
      v-bind="$attrs"
      v-bind:class="{'error': isValid}"
      >
      
        <label :for="name">{{label}}</label>
        <input :name="name" :id="name" :placeholder="placeholder || label" type="text"  
          v-bind:value="value"
          v-on:input="valueUpdated($event)"
        >
      </div>
    `
})

  var app = new Vue({
  el: '#form',
  data: {
    fullPage:false,
    step:0,
    formData: <?php echo json_encode($fields);?>,
    serverValidationErrors: <?php echo json_encode($this->validationErrors['Library'])?>,
    rules:{
      name(value){
        var regEx = /^[A-Za-z\/\s\.'-]+$/
        return regEx.test(value)
      },
      email(value){
        var regEx = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i
        return regEx.test(value)
      },
      phone(value){
        var regEx =  /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/
        return regEx.test(value)
      } 
    }
  },

  methods:{
    validate1(){
      return this.validate([
        this.$refs.first_name, 
        this.$refs.last_name, 
        this.$refs.phone, 
        this.$refs.email, 
      ])
    },
    validate2(){
      return this.validate(this.$refs)
    },
    

    fillInAddress(autocomplete) {
      // Get the place details from the autocomplete object.
      const place = autocomplete.getPlace();
        let address1 = "";
        let postcode = "";

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        // place.address_components are google.maps.GeocoderAddressComponent objects
        // which are documented at http://goo.gle/3l5i5Mr
        console.log(place.address_components)
        for (const component of place.address_components) {

          const componentType = component.types[0];
          console.log(component.types)

          switch (componentType) {
            case "street_number": {
              address1 = `${component.long_name} ${address1}`;
              break;
            }
            
            case "sublocality_level_1": {
              address1 = `${component.long_name} ${address1}`;
              break;
            }

            case "route": {
              address1 += component.short_name;
              break;
            }

            case "postal_code": {
              postcode = `${component.long_name}${postcode}`;
              break;
            }

            case "postal_code_suffix": {
              postcode = `${postcode}-${component.long_name}`;
              break;
            }
            case "locality":
             this.formData.city = component.long_name;
              break;
            case "administrative_area_level_1": {
              this.formData.state = component.long_name;
              break;
            }
            case "country":
              this.formData.country = component.long_name;
              break;
          }
        }
        this.formData.library_name = place.name;
        this.formData.library_address = place.formatted_address;
        this.formData.pincode = postcode;
    },
    validate(arr){
      console.log(arr)
      for(let ref in arr){

        if(!arr[ref]){
          return false;
        }
        if(arr[ref].errorMsg != ""){
          return false
        }
        if(arr[ref].$el.getAttribute("required") && arr[ref].value == ""){
          return false
        }
      }
      return true;
    },
    checkForm(e){
      //e.preventDefault();
      //return this.validate(this.$refs)
    },
   
  }
})


</script>

                                   