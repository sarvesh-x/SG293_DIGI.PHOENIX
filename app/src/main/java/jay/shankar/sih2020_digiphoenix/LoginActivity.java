package jay.shankar.sih2020_digiphoenix;

import android.Manifest;
import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Build;
import android.os.Bundle;
//import android.support.v4.app.ActivityCompat;
//import androidx.appcompat.app.AppCompatActivity;
//import android.support.v4.content.ContextCompat;
import android.provider.Settings;
import android.util.Patterns;
import android.view.ActionMode;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Toast;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AlertDialog;

import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.androidstudy.networkmanager.Monitor;
import com.androidstudy.networkmanager.Tovuti;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.regex.Pattern;

public class LoginActivity extends Activity implements LocationListener {

    public static final int REQUEST_ID_MULTIPLE_PERMISSIONS = 1;
    ProgressDialog progressDialog;
    private EditText email;
    LocationManager locationManager;
    private EditText password;
    private RequestQueue requestQueue;
    private static final String URL = "http://gyanamonline.com/rhcms/sih_files/logininfo.php";
    private StringRequest request;

    final public static ArrayList<String> user = new ArrayList<String>();


    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        getLocation();
        requestQueue = Volley.newRequestQueue(LoginActivity.this);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
        progressDialog = new ProgressDialog(LoginActivity.this);
        email = (EditText) findViewById(R.id.email);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.P) {
            email.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
                @Override
                public boolean onCreateActionMode(ActionMode mode, Menu menu) {
                    return false;
                }

                @Override
                public boolean onPrepareActionMode(ActionMode mode, Menu menu) {
                    return false;
                }

                @Override
                public boolean onActionItemClicked(ActionMode mode, MenuItem item) {
                    return false;
                }

                @Override
                public void onDestroyActionMode(ActionMode mode) {

                }
            });
        }
        email.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
            @Override
            public boolean onCreateActionMode(ActionMode mode, Menu menu) {
                return false;
            }

            @Override
            public boolean onPrepareActionMode(ActionMode mode, Menu menu) {
                return false;
            }

            @Override
            public boolean onActionItemClicked(ActionMode mode, MenuItem item) {
                return false;
            }

            @Override
            public void onDestroyActionMode(ActionMode mode) {

            }
        });
        email.setLongClickable(false);
        email.setTextIsSelectable(false);
        password = (EditText) findViewById(R.id.password);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.P) {
            password.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
                @Override
                public boolean onCreateActionMode(ActionMode mode, Menu menu) {
                    return false;
                }

                @Override
                public boolean onPrepareActionMode(ActionMode mode, Menu menu) {
                    return false;
                }

                @Override
                public boolean onActionItemClicked(ActionMode mode, MenuItem item) {
                    return false;
                }

                @Override
                public void onDestroyActionMode(ActionMode mode) {

                }
            });
        }
        password.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
            @Override
            public boolean onCreateActionMode(ActionMode mode, Menu menu) {
                return false;
            }

            @Override
            public boolean onPrepareActionMode(ActionMode mode, Menu menu) {
                return false;
            }

            @Override
            public boolean onActionItemClicked(ActionMode mode, MenuItem item) {
                return false;
            }

            @Override
            public void onDestroyActionMode(ActionMode mode) {

            }
        });
        password.setLongClickable(false);
        password.setTextIsSelectable(false);
        Button houseOwner = (Button) findViewById(R.id.houseOwner);
        houseOwner.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(LoginActivity.this,HouseOwnerActivity.class));
                finish();
            }
        });
        Button thirdPartySurvey = (Button) findViewById(R.id.thirdPartySurvey);
        thirdPartySurvey.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(LoginActivity.this,ThirdPartySurveyActivity.class));
            }
        });
        if(checkAndRequestPermissions()){
            Tovuti.from(this).monitor(new Monitor.ConnectivityListener(){
                @Override
                public void onConnectivityChanged(int connectionType, boolean isConnected, boolean isFast){
                    // TODO: Handle the connection...
                    if(isConnected) {
                    }
                    else {
                        AlertDialog.Builder alert = new AlertDialog.Builder(LoginActivity.this);
                        alert.setTitle("Error");
                        alert.setMessage("Connect to Internet for Sending Statistical Usage of App and Development");
                        alert.setPositiveButton("Settings", new DialogInterface.OnClickListener() {
                            @RequiresApi(api = Build.VERSION_CODES.P)
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

    public void login(View view){

        progressDialog.setMessage("Please Wait, Logging in...");
        progressDialog.show();

        request = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    progressDialog.dismiss();
                    JSONArray array = new JSONArray(response);
                    JSONObject t_array = array.getJSONObject(0);

                   // if (t_array.get("email").equals(email.getText().toString()) || t_array.get("password").equals(password.getText().toString())) {

                        user.add(t_array.get("name").toString());//stores name of the user    0
                        user.add(t_array.get("email").toString());//stores username of the user     1
                        user.add(t_array.get("t_id").toString());//stores tender ID alloted to the user    2
                        user.add(t_array.get("dob").toString());//stores the date of birth of the user      3
                        user.add(t_array.get("mobile").toString());//stores the mobile no. of the user     4
                        user.add(t_array.get("address").toString());//stores the address of the user       5

                        Toast.makeText(LoginActivity.this, "Welcome " + user.get(0), Toast.LENGTH_SHORT).show();
                        //Intent intent = new Intent(LoginActivity.this, HomeActivity.class);
                        //intent.putExtra("username", email.getText().toString());
                        startActivity(new Intent(LoginActivity.this,HomeActivity.class));

                   // } else {
                       // Toast.makeText(getApplicationContext(), "Wrong Username or Password!", Toast.LENGTH_SHORT).show();
                   // }

                } catch (JSONException e) {
                    e.printStackTrace();
                }


            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

                progressDialog.dismiss();
            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                HashMap<String, String> hashMap = new HashMap<String, String>();
                hashMap.put("email", email.getText().toString());
                hashMap.put("password", password.getText().toString());
                return hashMap;
            }
        };

        Volley.newRequestQueue(LoginActivity.this).add(request);

    }
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
                        Toast.makeText(LoginActivity.this,"Enable it Manually to Upload Images",Toast.LENGTH_SHORT).show();
                        dialog.cancel();
                    }
                });
        final AlertDialog alert = builder.create();
        alert.show();
    }


    private boolean checkAndRequestPermissions() {
        int permissionSendMessage = ContextCompat.checkSelfPermission(this,
                Manifest.permission.CAMERA);
        int permissionRead = ContextCompat.checkSelfPermission(this,
                Manifest.permission.READ_EXTERNAL_STORAGE);
        int permissionWrite = ContextCompat.checkSelfPermission(this,
                Manifest.permission.READ_EXTERNAL_STORAGE);
        int locationPermission = ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION);
        List<String> listPermissionsNeeded = new ArrayList<>();
        if (locationPermission != PackageManager.PERMISSION_GRANTED) {
            listPermissionsNeeded.add(Manifest.permission.ACCESS_FINE_LOCATION);
        }
        if (permissionSendMessage != PackageManager.PERMISSION_GRANTED) {
            listPermissionsNeeded.add(Manifest.permission.CAMERA);
        }
        if (permissionRead != PackageManager.PERMISSION_GRANTED) {
            listPermissionsNeeded.add(Manifest.permission.READ_EXTERNAL_STORAGE);
        }
        if (permissionWrite != PackageManager.PERMISSION_GRANTED) {
            listPermissionsNeeded.add(Manifest.permission.WRITE_EXTERNAL_STORAGE);
        }
        if (!listPermissionsNeeded.isEmpty()) {
            ActivityCompat.requestPermissions(this, listPermissionsNeeded.toArray(new String[listPermissionsNeeded.size()]),REQUEST_ID_MULTIPLE_PERMISSIONS);
            return false;
        }
        return true;
    }

    @Override
    public void onLocationChanged(Location location) {

    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {

    }

    @Override
    public void onProviderEnabled(String provider) {

    }

    @Override
    public void onProviderDisabled(String provider) {

    }
}