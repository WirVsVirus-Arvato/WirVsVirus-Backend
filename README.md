Next: AdminLTE Configuration 
                              

  * Finish bundle configuration:
    1. Open config/packages/admin_lte.yaml and adjust to your needs
    2. Create a layout file that uses:

    {% extends '@AdminLTE/layout/default-layout.html.twig' %}

Documentation: https://github.com/kevinpapst/AdminLTEBundle/blob/master/Resources/docs/


OK Done!

 Show written file names? (yes/no) [yes]:
 > y

 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/config/packages/messenger.yaml
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/config/packages/msgphp_user.make.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/config/packages/security.yaml
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/config/routes/user.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Console/ClassContextElementFactory.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Controller/ForgotPasswordController.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Controller/LoginController.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Controller/ProfileController.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Controller/RegisterController.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Controller/ResetPasswordController.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Entity/Role.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Entity/User.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Entity/UserRole.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Form/ChangeEmailType.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Form/ChangePasswordType.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Form/ForgotPasswordType.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Form/LoginType.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Form/RegisterType.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/src/Form/ResetPasswordType.php
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/templates/@AdminLTE/layout/security-layout.html.twig
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/templates/user/forgot_password.html.twig
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/templates/user/login.html.twig
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/templates/user/profile.html.twig
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/templates/user/register.html.twig
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/templates/user/reset_password.html.twig
 * /Users/koehler/Documents/Privat/OpenDMS2/opendms/translations/messages+intl-icu.en.xlf

 ! [NOTE] Don't forget to update your database schema, if needed     