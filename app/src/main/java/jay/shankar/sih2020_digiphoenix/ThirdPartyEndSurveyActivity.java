package jay.shankar.sih2020_digiphoenix;

import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.WindowManager;

public class ThirdPartyEndSurveyActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_third_party_end_survey);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
    }

    public void endSurvey(View view){
        startActivity(new Intent(ThirdPartyEndSurveyActivity.this,ThirdPartyHomeActivity.class));
        finish();
    }
}