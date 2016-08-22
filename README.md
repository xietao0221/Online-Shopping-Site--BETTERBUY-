# Online Shopping Site BETTERBUY

### Author: Tao Xie (USC ID: 5951684215)
### Date: 2015/07/21
### URL: http://taoxieusc.com/project/usc/webTech/hw4/CI/index.php/Pagedisplay/homepage
### username and password:
    taoxie@usc.edu / taoxie
    xie0221@126.com / taoxie

NOTE:  This site is perfectly displayed on almost all kinds of screen, like wide-width screen, laptop, tablet and cellphone.

## 1. Overview
My company’s customer-side website is about selling musical instruments, and it has a good name: BETTERBUY, the slogan is “no best, only better”. There are 5 kinds of instruments we sell: woodwind, brass, string, keyboard and percussion, every category has at least one special sales product. Because this homework is just rewrite the prior webpage, the function and operation is exactly the same as homework3’s. If you want to know how to use my page, the prior writeup file is put at the end of this file.
In this homework, I rewrite and modify my code using CodeIgniter and jQuery, and add more CSS and jQuery code to make my page adjust all kinds of screen. 

## 2. CodeIgniter
In order to put code into CodeIgniter, I divide my codes into 4 parts based on their similar functions: product display, customer login and validation, product purchase, sign up and profile edit.

###2.1 Product Display
Controller: Pagedisplay.php
Model: Pagedisplay_model.php
View: homeBETTERBUY.php, showSingleCategory.php, showSingleProduct.php, keywordSearch.php
homeBETTERBUY.php is the homepage of my company, and it displays all category’s picture, and let customer to hit to view. In homepage() function, data related to category name is got from database, and is sent to View.
After hitting the category’s picture or the category name on the submenu on top of screen, customer can see the entire products of the category. Like the prior page, an array named $data is filled with product information by Model and is sent to View.
The design of page of single product and keyword search is similar to the homepage.

### 2.2 Customer Login and Validation
Controller: Loginout.php
Model: Loginou_model.php
View: customerLogin.php
There are only three functions in the controller and model in this part. The first one is customerLogin(), username and password are got on customerLogin.php, and they are validated by both brower and server, and then database is queried to get customer information. If the identity is validated correctly, the signin/up icon on the top of screen is turned to be the name of customer, and when customer move mouse over this new icon, a customer dashboard is pop up to let people review their profile, orders, and logout. 
The second function is customerlogout(), session is destroyed in this function, and page is redirected to homepage.
The third function is validateCustomerLogin(). Every time when customer visit my site, this function is called to validate the identity of customer, if the session information is correct based on the database query, this customer is allowed to continuous operation, like order placing, profile edit and so on. If the session information is not correct, the session is destroyed and let people to type in their username and password. And a timer of 5 minutes is set in this function to logout automatically if customer does not do anything for 5 minutes.

### 2.3 Sign up and Profile Edit
Controller: Signupmodify.php
Model: Signupmodify_model.php
View: customerSignup.php, customerSignUpResult.php, customerAccount.php, customerModifyResult.php
In function customerAddUser(), all profile information are got and validated by Javascript and php, and then the related function in model is called to insert data into database. In this process, some validation are processed, like whether you enter a existed username, whether the information are valid, and so on.
The function about profile edit is similar to the prior one. 

### 2.4 Product Purchase
Controller: Productpurchase.php
Model: Productpurchase_model.php
View: customerOrders.php, customerOrdersDetail.php, shoppingCart.php, customerAddProduct.php
When people add some product into their shopping cart, the function customerAddProduct() is called, and the product is inserted into shopping cart table, and then when people place an order, shoppingCart() is called, and all products in the shopping cart are emptied and an order is placed, and all shipping information is stored into orderSummary table.

## 3. jQuery
All Javascript codes are rewrote using jQuery. All jQuery codes are in the folder of /CI/assets/js/

## 4. CSS and Responsive Web Design
In order to adjust my page with all kinds of screen, some CSS codes are added. For different view page, 2 or 3 sets of CSS codes are composed to make my page perfectly displayed on almost all kinds of screen. The following are some screen shots. All CSS codes are in the folder of /CI/assets/css

## 5. Security
All data typed in are validated by Javascript and PHP using regular expression and special character filter, and Query Bindings is used to avoid SQL injection.
