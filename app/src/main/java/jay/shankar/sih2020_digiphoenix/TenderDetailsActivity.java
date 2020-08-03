package jay.shankar.sih2020_digiphoenix;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import android.Manifest;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Build;
import android.os.Bundle;
import android.provider.Settings;
import android.view.View;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.androidstudy.networkmanager.Monitor;
import com.androidstudy.networkmanager.Tovuti;
import com.mindorks.paracamera.Camera;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class TenderDetailsActivity extends AppCompatActivity {

    private static final String TENDER_DETAILS_URL = "http://gyanamonline.com/rhcms/sih_files/tender_details.php";
    public String tender_id,tender_type,tender_name,tender_issue_date,tender_due_date,tender_budget,tender_details,tender_exp_budget;
    private TextView t_id,t_type,t_name,t_issue_date,t_due_date,t_budget,t_details,t_exp_budget;
    LocationManager locationManager;

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
                        Toast.makeText(TenderDetailsActivity.this,"Enable it Manually to Upload Images",Toast.LENGTH_SHORT).show();
                        dialog.cancel();
                    }
                });
        final AlertDialog alert = builder.create();
        alert.show();
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tender_details);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
        getLocation();
        getDetails();
        Tovuti.from(this).monitor(new Monitor.ConnectivityListener(){
            @Override
            public void onConnectivityChanged(int connectionType, boolean isConnected, boolean isFast){
                // TODO: Handle the connection...
                if(isConnected)
                {
                    getDetails();
                }
                else {
                    AlertDialog.Builder alert = new AlertDialog.Builder(TenderDetailsActivity.this);
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

    public void getDetails(){
        StringRequest stringRequest = new StringRequest(Request.Method.POST, TENDER_DETAILS_URL,
                new Response.Listener<String>() {
                    // @SuppressLint("SetTextI18n")
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONArray array = new JSONArray(response);
                            JSONObject t_details_current = array.getJSONObject(0);

                            tender_id = t_details_current.get("t_id").toString();
                            tender_type = t_details_current.get("t_type").toString();
                            tender_name = t_details_current.get("t_name").toString();
                            tender_issue_date = t_details_current.get("t_issue_date").toString();
                            tender_due_date = t_details_current.get("t_due_date").toString();
                            tender_budget = t_details_current.get("t_budget").toString();
                            tender_details = t_details_current.get("t_details").toString();
                            tender_exp_budget = t_details_current.get("exp_budget").toString();

                            t_id = findViewById(R.id.tender_id);
                            t_type = findViewById(R.id.tender_type);
                            t_name = findViewById(R.id.tender_name);
                            t_issue_date = findViewById(R.id.tender_issue_date);
                            t_due_date = findViewById(R.id.tender_due_date);
                            t_budget = findViewById(R.id.tender_budget);
                            t_details = findViewById(R.id.tender_details);
                            t_exp_budget = findViewById(R.id.tender_exp_budget);

                            t_id.setText("TENDER ID: "+tender_id.toString());
                            t_type.setText("TENDER TYPE: "+tender_type.toString());
                            t_name.setText("TENDER NAME: "+tender_name.toString());
                            t_issue_date.setText("TENDER ISSUE DATE: "+tender_issue_date.toString());
                            t_due_date.setText("TENDER DUE DATE: "+tender_due_date.toString());
                            t_details.setText("TENDER_DETAILS: "+tender_details.toString());
                            t_exp_budget.setText("TENDER EXPANEDED BUDGET: "+tender_exp_budget.toString());

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                    }
                }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {

            }
        }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                HashMap<String,String> hashMap = new HashMap<String, String>();
                hashMap.put("t_id",LoginActivity.user.get(2));
                return hashMap;
            }
        };

        Volley.newRequestQueue(TenderDetailsActivity.this).add(stringRequest);
    }

}