package jay.shankar.sih2020_digiphoenix;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.provider.Settings;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.Toast;

import com.androidstudy.networkmanager.Monitor;
import com.androidstudy.networkmanager.Tovuti;

public class UploadSuccessActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_upload_success);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
        Tovuti.from(this).monitor(new Monitor.ConnectivityListener(){
            @Override
            public void onConnectivityChanged(int connectionType, boolean isConnected, boolean isFast){
                // TODO: Handle the connection...
                if(isConnected)
                {
                    Button btn = findViewById(R.id.finish_final_btn);
                    btn.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View v) {
                            Intent intent = new Intent(UploadSuccessActivity.this,HomeActivity.class);
                            startActivity(intent);
                            finish();
                        }
                    });
                }
                else {
                    AlertDialog.Builder alert = new AlertDialog.Builder(UploadSuccessActivity.this);
                    alert.setTitle("Error");
                    alert.setMessage("Connect to Internet for Sending Statistical Usage of App and Development");
                    alert.setPositiveButton("Settings", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            startActivity(new Intent(Settings.ACTION_DATA_USAGE_SETTINGS));
                        }
                    });
                    alert.setCancelable(false);
                    alert.create();
                    alert.show();
                }
            }
        });

    }
}