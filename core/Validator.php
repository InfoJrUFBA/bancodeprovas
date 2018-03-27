<?php

    namespace Core;

    class Validator{

        public static function make(array $data, array $rules){

            $errors = null;

            foreach ($rules as $ruleKey => $ruleValue) {

                foreach ($data as $dataKey => $dataValue) {
                    if($ruleKey == $dataKey){
                        switch ($ruleValue) {
                            case 'required':
                                if($dataValue == ' ' || empty($dataValue) ){
                                    $errors["$ruleKey"] = "O campo {$ruleKey} deve ser preenchido.";
                                }
                                break;

                            case 'email':
                                if(!filter_var($dataValue, FILTER_VALIDATE_EMAIL)){
                                    $errors["$ruleKey"] = "O campo {$ruleKey} não é válido.";
                                }
                                break;
                        }
                    }
                }

            }

            if($errors){
                Session::set('errors', $errors);
                return true;
            }else {
                Session::destroy('errors');
                return false;
            }
        }

    }
