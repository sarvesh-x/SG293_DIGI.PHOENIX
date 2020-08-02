package jay.shankar.sih2020_digiphoenix.Models;

public class Notification {

    private String subject;
    private String message;

    public Notification(String subject, String message) {
        this.subject = subject;
        this.message = message;
    }

    public String getsubject() {
        return this.subject;
    }

    public String getmessage() {
        return message;
    }
}