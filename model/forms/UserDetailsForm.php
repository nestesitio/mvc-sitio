<?php

/*
 * Copyright (C) 2017 Luis Pinto <luis.nestesitio@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Model\forms;

use \Model\models\UserDetails;

/**
 * Description of UserDetailsForm
 *
 * @author Luís Pinto / luis.nestesitio@gmail.com
 * Created @2018-01-19 18:03
 * Updated @Updated @2018-01-19 18:03 with columns user_id, address, zip_code, local *
 */
class UserDetailsForm extends \Catrineta\form\Form {

    /**
     * 
     * @param boolean $declare
     * @return \Model\forms\UserDetailsForm
     */
    public static function initialize($declare = true){
        $form = new UserDetailsForm();
        if($declare == true){
            $form->declareInputs();
        }
        return $form;
    }
    
    /**
     * Initialize all inputs
     * @return $this
     */
    public function declareInputs(){
        $this->models[UserDetails::TABLE] = new UserDetails();
        
        $this->setUserIdInput();
        $this->setAddressInput();
        $this->setZipCodeInput();
        $this->setLocalInput();
        return $this;
    }
    
    public function validate(){
        
        $this->validateUserIdInput();
        $this->validateAddressInput();
        $this->validateZipCodeInput();
        $this->validateLocalInput();
        
        return $this;
    }
    
    
    
    
    /**
    * Create and return the input associeted with field
    * 
    * @return \lib\form\input\HiddenInput;
    */
    public function setUserIdInput($input = null) {
        if($input == null){
            $input = \Catrineta\form\inputs\HiddenInput::create(UserDetails::FIELD_USER_DETAILS_USER_ID);
        }else{
            $input->setElementId(UserDetails::FIELD_USER_DETAILS_USER_ID); 
        }
        
        $this->setFieldInput(UserDetails::FIELD_USER_DETAILS_USER_ID, $input);
        
        return $input;
    }
    
    public function setUserIdDefault($value) {
        $this->setDefault(UserDetails::TABLE, UserDetails::FIELD_USER_DETAILS_USER_ID, $value);
    }
    
    public function unsetUserIdInput() {
        $this->unsetFieldInput(UserDetails::FIELD_USER_DETAILS_USER_ID);
    }
    
    /**
    * @return \lib\form\input\HiddenInput;
    */
    public function getUserIdInput(){
        return $this->forminputs[UserDetails::FIELD_USER_DETAILS_USER_ID];
    }
    
    public function getUserIdValue(){
        return $this->getInputValue(UserDetails::FIELD_USER_DETAILS_USER_ID);
    }
    
    public function validateUserIdInput() {
        $input = $this->getUserIdInput();
        return $input->validate();
    }
    
    
    
    /**
    * Create and return the input associeted with field
    * 
    * @return \lib\form\input\InputText;
    */
    public function setAddressInput($input = null) {
        if($input == null){
            $input = \Catrineta\form\inputs\InputText::create(UserDetails::FIELD_USER_DETAILS_ADDRESS)->setMaxlength('150');
        }else{
            $input->setElementId(UserDetails::FIELD_USER_DETAILS_ADDRESS); 
        }
        
        $this->setFieldInput(UserDetails::FIELD_USER_DETAILS_ADDRESS, $input);
        
        return $input;
    }
    
    public function setAddressDefault($value) {
        $this->setDefault(UserDetails::TABLE, UserDetails::FIELD_USER_DETAILS_ADDRESS, $value);
    }
    
    public function unsetAddressInput() {
        $this->unsetFieldInput(UserDetails::FIELD_USER_DETAILS_ADDRESS);
    }
    
    /**
    * @return \lib\form\input\InputText;
    */
    public function getAddressInput(){
        return $this->forminputs[UserDetails::FIELD_USER_DETAILS_ADDRESS];
    }
    
    public function getAddressValue(){
        return $this->getInputValue(UserDetails::FIELD_USER_DETAILS_ADDRESS);
    }
    
    public function validateAddressInput() {
        $input = $this->getAddressInput();
        return $input->validate();
    }
    
    
    
    /**
    * Create and return the input associeted with field
    * 
    * @return \lib\form\input\InputText;
    */
    public function setZipCodeInput($input = null) {
        if($input == null){
            $input = \Catrineta\form\inputs\InputText::create(UserDetails::FIELD_USER_DETAILS_ZIP_CODE)->setMaxlength('30');
        }else{
            $input->setElementId(UserDetails::FIELD_USER_DETAILS_ZIP_CODE); 
        }
        
        $this->setFieldInput(UserDetails::FIELD_USER_DETAILS_ZIP_CODE, $input);
        
        return $input;
    }
    
    public function setZipCodeDefault($value) {
        $this->setDefault(UserDetails::TABLE, UserDetails::FIELD_USER_DETAILS_ZIP_CODE, $value);
    }
    
    public function unsetZipCodeInput() {
        $this->unsetFieldInput(UserDetails::FIELD_USER_DETAILS_ZIP_CODE);
    }
    
    /**
    * @return \lib\form\input\InputText;
    */
    public function getZipCodeInput(){
        return $this->forminputs[UserDetails::FIELD_USER_DETAILS_ZIP_CODE];
    }
    
    public function getZipCodeValue(){
        return $this->getInputValue(UserDetails::FIELD_USER_DETAILS_ZIP_CODE);
    }
    
    public function validateZipCodeInput() {
        $input = $this->getZipCodeInput();
        return $input->validate();
    }
    
    
    
    /**
    * Create and return the input associeted with field
    * 
    * @return \lib\form\input\InputText;
    */
    public function setLocalInput($input = null) {
        if($input == null){
            $input = \Catrineta\form\inputs\InputText::create(UserDetails::FIELD_USER_DETAILS_LOCAL)->setMaxlength('100');
        }else{
            $input->setElementId(UserDetails::FIELD_USER_DETAILS_LOCAL); 
        }
        
        $this->setFieldInput(UserDetails::FIELD_USER_DETAILS_LOCAL, $input);
        
        return $input;
    }
    
    public function setLocalDefault($value) {
        $this->setDefault(UserDetails::TABLE, UserDetails::FIELD_USER_DETAILS_LOCAL, $value);
    }
    
    public function unsetLocalInput() {
        $this->unsetFieldInput(UserDetails::FIELD_USER_DETAILS_LOCAL);
    }
    
    /**
    * @return \lib\form\input\InputText;
    */
    public function getLocalInput(){
        return $this->forminputs[UserDetails::FIELD_USER_DETAILS_LOCAL];
    }
    
    public function getLocalValue(){
        return $this->getInputValue(UserDetails::FIELD_USER_DETAILS_LOCAL);
    }
    
    public function validateLocalInput() {
        $input = $this->getLocalInput();
        return $input->validate();
    }
    
    
    
    
    
    

}
