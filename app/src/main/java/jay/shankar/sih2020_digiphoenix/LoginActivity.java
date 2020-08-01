package jay.shankar.sih2020_digiphoenix;

import android.Manifest;
import android.app.Activity;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.os.Build;
import android.os.Bundle;
import android.provider.Settings;
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

public class LoginActivity extends Activity {

    public static final int REQUEST_ID_MULTIPLE_PERMISSIONS = 1;
    ProgressDialog progressDialog;
    private SharedPreferences loginPreferences;
    private SharedPreferences.Editor loginPrefsEditor;
    private Boolean saveLogin;
    private CheckBox remeberme;
    private CheckBox houseowner;
    private EditText email;
    private EditText password;
    //private Button sign_in;
    private RequestQueue requestQueue;
    private static final String URL = "http://gyanamonline.com/rhcms/sih_files/logininfo.php";
    private StringRequest request;

    final public static ArrayList<String> user = new ArrayList<String>();


    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
        progressDialog = new ProgressDialog(LoginActivity.this);
        email = (EditText) findViewById(R.id.email);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
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
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
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
        Button thirdPartySurvey = (Button) findViewById(R.id.thirdPartySurvey);
        Button sign_in = (Button) findViewById(R.id.sign_in);
        requestQueue = Volley.newRequestQueue(LoginActivity.this);
        sign_in.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (email.getText().length() != 0 || password.getText().length() != 0) {
                    login();
                }else
                    Toast.makeText(LoginActivity.this,"Invalid Email or Password!",Toast.LENGTH_SHORT).show();
            }
        });
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

    private void login(){

        progressDialog.setMessage("Please Wait, Logging in...");
        progressDialog.show();

        request = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    progressDialog.dismiss();
                    JSONArray array = new JSONArray(response);
                    JSONObject t_array = array.getJSONObject(0);

                    if (t_array.get("email").equals(email.getText().toString()) || t_array.get("password").equals(password.getText().toString())) {

                        user.add(t_array.get("name").toString());//stores name of the user    0
                        user.add(t_array.get("email").toString());//stores username of the user     1
                        user.add(t_array.get("t_id").toString());//stores tender ID alloted to the user    2
                        user.add(t_array.get("dob").toString());//stores the date of birth of the user      3
                        user.add(t_array.get("mobile").toString());//stores the mobile no. of the user     4
                        user.add(t_array.get("address").toString());//stores the address of the user       5

                        Toast.makeText(getApplicationContext(), "Welcome " + user.get(0), Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(getApplicationContext(), HomeActivity.class);
                        intent.putExtra("username", email.getText().toString());
                        startActivity(intent);

                    } else {
                        Toast.makeText(getApplicationContext(), "Wrong Username or Password!", Toast.LENGTH_SHORT).show();
                    }

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

        requestQueue.add(request);

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

}