<?php

class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('user/login');
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('Sign in');

    }

    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Login cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'login-form[login]' => 'admin',
            'login-form[password]' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Invalid login or password');
    }

    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'login-form[login]' => 'admin',
            'login-form[password]' => ' admin123*',
        ]);
        $I->see('Sign out (admin)');
        $I->dontSeeElement('form#login-form');              
    }
}