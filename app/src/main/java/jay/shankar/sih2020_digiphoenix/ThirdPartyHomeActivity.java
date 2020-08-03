package jay.shankar.sih2020_digiphoenix;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import android.Manifest;
import android.annotation.SuppressLint;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.provider.Settings;
import android.view.View;
import android.view.WindowManager;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.Toast;

import com.androidstudy.networkmanager.Monitor;
import com.androidstudy.networkmanager.Tovuti;


public class ThirdPartyHomeActivity extends AppCompatActivity {

    LocationManager locationManager;
    String user_id = ThirdPartySurveyActivity.thirdParty.get(0);
    public void getLocation () {
        locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // TODO: Consider calling
            //    ActivityCompat#requestPermissions
            // here to request the missing permissions, and then overriding
            // public void onRequestPermissionsResult(int requestCode, String[] permissions,
            //                                          int[] grantResults)
            // to handle the case where the user grants the permission. See the documentation
            // for ActivityCompat#requestPermissions for more details.
            return;
        }
        locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 500, 5, (LocationListener) this);
        if (!locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER)) {
            buildAlertMessageNoGps();
        }
    }

    private void buildAlertMessageNoGps () {
        final AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setMessage("Your GPS seems to be disabled, Enable it Upload Images?")
                .setCancelable(false)
                .setPositiveButton("Enable", new DialogInterface.OnClickListener() {
                    public void onClick(@SuppressWarnings("unused") final DialogInterface dialog, @SuppressWarnings("unused") final int id) {
                        startActivity(new Intent(android.provider.Settings.ACTION_LOCATION_SOURCE_SETTINGS));
                    }
                })
                .setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    public void onClick(final DialogInterface dialog, @SuppressWarnings("unused") final int id) {
                        Toast.makeText(ThirdPartyHomeActivity.this,"Enable it Manually to Upload Images",Toast.LENGTH_SHORT).show();
                        dialog.cancel();
                    }
                });
        final AlertDialog alert = builder.create();
        alert.show();
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_third_party_home);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
        getLocation();
        Tovuti.from(this).monitor(new Monitor.ConnectivityListener(){
            @SuppressLint("SetJavaScriptEnabled")
            @Override
            public void onConnectivityChanged(int connectionType, boolean isConnected, boolean isFast){
                // TODO: Handle the connection...
                if(isConnected)
                {
                    Button btn = findViewById(R.id.thirdPartyHome_NextBtn);
                    final WebView mywebview = (WebView) findViewById(R.id.thirdParty_webView);
                    mywebview.setWebViewClient(new WebViewClient());
                    mywebview.getSettings().setJavaScriptEnabled(true);
                    mywebview.setWebChromeClient(new WebChromeClient());
                    mywebview.getSettings().setDomStorageEnabled(true);
                    mywebview.loadUrl("http://gyanamonline.com/rhcms/admin/third/?id="+user_id);

                    btn.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View v) {
                            String url = mywebview.getUrl();
                            startActivity(new Intent(ThirdPartyHomeActivity.this,ThirdPartyFeedbackActivity.class));
                            finish();
                        }
                    });
                }
                else {
                    AlertDialog.Builder alert = new AlertDialog.Builder(ThirdPartyHomeActivity.this);
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
    @Override
    protected void onStop(){
        Tovuti.from(this).stop();
        super.onStop();
    }

}