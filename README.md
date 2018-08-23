# ci_notification_helper
CI Notification for Android Push Notif from Firebase and Email Config

installation
1. copy this file and save to your_ci_project\Application\helper\
2. add to your controller 
    $this->load->helper('pushnotif');
3. Change Your_API_Key and Setting SMTP with your smtp
4. use notification with tag:
    Android Notification : 
      pushnotif('firebase_reg_id or topic/your_topic','Title','Content');
    Email Notification :
      pushmail('email receipient','Subject',$data);
