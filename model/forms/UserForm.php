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

use \Model\models\User;

/**
 * Description of UserForm
 *
 * @author Luís Pinto / luis.nestesitio@gmail.com
 * Created @2017-09-22 17:25
 * Updated @Updated @2017-09-22 17:25 with columns id, name, email, cellphone, user_status, created *
 */
class UserForm extends \Catrineta\form\Form {

    public static function initialize($declare = true){
        $form = new UserForm();
        if($declare == true){
            $form->declareInputs();
        }
        return $form;
    }
    
    
    public function declareInputs(){
        $this->queue[] = User::TABLE;
        $this->models[User::TABLE] = new User();
        
        return $this;
    }
    
    public function validate(){
        
        $this->validateIdInput();
        $this->validateNameInput();
        $this->validateEmailInput();
        $this->validateCellphoneInput();
        $this->validateUserStatusInput();
        
        return $this;
    }
    
    
    
    
    /**
    * Create and return the input associeted with field
    * 
    * @return \lib\form\input\InputText;
    */
    public function setNameInput($input = null) {
        if($input == null){
            $input = \Catrineta\form\input\InputText::create(User::FIELD_USER_NAME)->setMaxlength('100');
        }else{
            $input->setElementId(User::FIELD_USER_NAME); 
        }
        
        $this->setFieldInput(User::TABLE, User::FIELD_USER_NAME, $input);
        
        return $input;
    }
    
    public function setNameDefault($value) {
        $this->setDefault(User::TABLE, User::FIELD_USER_NAME, $value);
    }
    
    public function unsetNameInput() {
        $this->unsetFieldInput(User::TABLE, User::FIELD_USER_NAME);
    }
    
    /**
    * @return \lib\form\input\InputText;
    */
    public function getNameInput(){
        return $this->forminputs[User::TABLE][User::FIELD_USER_NAME];
    }
    
    public function getNameValue(){
        return $this->getInputValue(User::TABLE, User::FIELD_USER_NAME);
    }
    
    public function validateNameInput() {
        $input = $this->getNameInput();
        return $input->validate();
    }
    
    
    
    /**
    * Create and return the input associeted with field
    * 
    * @return \lib\form\input\InputText;
    */
    public function setEmailInput($input = null) {
        if($input == null){
            $input = \Catrineta\form\input\InputText::create(User::FIELD_USER_EMAIL)->setMaxlength('150');
        }else{
            $input->setElementId(User::FIELD_USER_EMAIL); 
        }
        
        $this->setFieldInput(User::TABLE, User::FIELD_USER_EMAIL, $input);
        
        return $input;
    }
    
    public function setEmailDefault($value) {
        $this->setDefault(User::TABLE, User::FIELD_USER_EMAIL, $value);
    }
    
    public function unsetEmailInput() {
        $this->unsetFieldInput(User::TABLE, User::FIELD_USER_EMAIL);
    }
    
    /**
    * @return \lib\form\input\InputText;
    */
    public function getEmailInput(){
        return $this->forminputs[User::TABLE][User::FIELD_USER_EMAIL];
    }
    
    public function getEmailValue(){
        return $this->getInputValue(User::TABLE, User::FIELD_USER_EMAIL);
    }
    
    public function validateEmailInput() {
        $input = $this->getEmailInput();
        return $input->validate();
    }
    
    
    
    /**
    * Create and return the input associeted with field
    * 
    * @return \lib\form\input\InputText;
    */
    public function setCellphoneInput($input = null) {
        if($input == null){
            $input = \Catrineta\form\input\InputText::create(User::FIELD_USER_CELLPHONE)->setMaxlength('20');
        }else{
            $input->setElementId(User::FIELD_USER_CELLPHONE); 
        }
        
        $this->setFieldInput(User::TABLE, User::FIELD_USER_CELLPHONE, $input);
        
        return $input;
    }
    
    public function setCellphoneDefault($value) {
        $this->setDefault(User::TABLE, User::FIELD_USER_CELLPHONE, $value);
    }
    
    public function unsetCellphoneInput() {
        $this->unsetFieldInput(User::TABLE, User::FIELD_USER_CELLPHONE);
    }
    
    /**
    * @return \lib\form\input\InputText;
    */
    public function getCellphoneInput(){
        return $this->forminputs[User::TABLE][User::FIELD_USER_CELLPHONE];
    }
    
    public function getCellphoneValue(){
        return $this->getInputValue(User::TABLE, User::FIELD_USER_CELLPHONE);
    }
    
    public function validateCellphoneInput() {
        $input = $this->getCellphoneInput();
        return $input->validate();
    }
    
    
    
    
    
    
    /**
    * Create and return the input associeted with field
    * 
    * @return \lib\form\input\SelectInput;
    */
    public function setIdInput($input = null) {
        if($input == null){
            $input = \Catrineta\form\input\SelectInput::create(User::FIELD_USER_ID)
                ->setModel(\Model\querys\UserLogQuery::start())
		->setOptionIndex(\Model\models\UserLog::FIELD_USER_LOG_USER_ID)->addEmpty()
                ->setRequired(true)
                ->setDefault('null');
        }else{
            $input->setElementId(User::FIELD_USER_ID); 
        }
        
        $this->setFieldInput(User::TABLE, User::FIELD_USER_ID, $input);
        
        return $input;
    }
    
    public function setIdDefault($value) {
        $this->setDefault(User::TABLE, User::FIELD_USER_ID, $value);
    }
    
    public function unsetIdInput() {
        $this->unsetFieldInput(User::TABLE, User::FIELD_USER_ID);
    }
    
    /**
    * @return \lib\form\input\SelectInput;
    */
    public function getIdInput(){
        return $this->forminputs[User::TABLE][User::FIELD_USER_ID];
    }
    
    public function getIdValue(){
        return $this->getInputValue(User::TABLE, User::FIELD_USER_ID);
    }
    
    public function validateIdInput() {
        $input = $this->getIdInput();
        return $input->validate();
    }
    
    
    
    /**
    * Create and return the input associeted with field
    * 
    * @return \lib\form\input\SelectInput;
    */
    public function setUserStatusInput($input = null) {
        if($input == null){
            $input = \Catrineta\form\input\SelectInput::create(User::FIELD_USER_USER_STATUS)
                ->setModel(\Model\querys\UserStatusQuery::start())
		->setOptionIndex(\Model\models\UserStatus::FIELD_USER_STATUS_ID)->addEmpty()
                ->setRequired(true)
                ->setDefault('null');
        }else{
            $input->setElementId(User::FIELD_USER_USER_STATUS); 
        }
        
        $this->setFieldInput(User::TABLE, User::FIELD_USER_USER_STATUS, $input);
        
        return $input;
    }
    
    public function setUserStatusDefault($value) {
        $this->setDefault(User::TABLE, User::FIELD_USER_USER_STATUS, $value);
    }
    
    public function unsetUserStatusInput() {
        $this->unsetFieldInput(User::TABLE, User::FIELD_USER_USER_STATUS);
    }
    
    /**
    * @return \lib\form\input\SelectInput;
    */
    public function getUserStatusInput(){
        return $this->forminputs[User::TABLE][User::FIELD_USER_USER_STATUS];
    }
    
    public function getUserStatusValue(){
        return $this->getInputValue(User::TABLE, User::FIELD_USER_USER_STATUS);
    }
    
    public function validateUserStatusInput() {
        $input = $this->getUserStatusInput();
        return $input->validate();
    }
    
    
    

}