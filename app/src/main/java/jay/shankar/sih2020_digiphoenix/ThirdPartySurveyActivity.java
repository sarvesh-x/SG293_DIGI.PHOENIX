package jay.shankar.sih2020_digiphoenix;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.location.LocationListener;
import android.location.LocationManager;
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
import java.util.Map;

public class ThirdPartySurveyActivity extends AppCompatActivity {

    ProgressDialog progressDialog;
    private EditText email_thirdParty,password_thirdParty;
    private Button sign_in;
    LocationManager locationManager;
    private RequestQueue requestQueue2;
    private static final String URL2 = "http://gyanamonline.com/rhcms/sih_files/login_third_party.php";
    private StringRequest request2;
    final public static ArrayList<String> thirdParty = new ArrayList<String>();


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_third_party_survey);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
       // getLocation();
        Tovuti.from(this).monitor(new Monitor.ConnectivityListener(){
            @Override
            public void onConnectivityChanged(int connectionType, boolean isConnected, boolean isFast){
                // TODO: Handle the connection...
                if(isConnected)
                {
                    progressDialog = new ProgressDialog(ThirdPartySurveyActivity.this);
                    email_thirdParty = (EditText) findViewById(R.id.email_thirdParty);
                    if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
                        email_thirdParty.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
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
                    email_thirdParty.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
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
                    email_thirdParty.setLongClickable(false);
                    email_thirdParty.setTextIsSelectable(false);
                    password_thirdParty = (EditText) findViewById(R.id.password_thirdParty);
                    if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
                        password_thirdParty.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
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
                    password_thirdParty.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
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
                    password_thirdParty.setLongClickable(false);
                    password_thirdParty.setTextIsSelectable(false);
                    sign_in = (Button) findViewById(R.id.sign_in_thirdParty);
                    requestQueue2 = Volley.newRequestQueue(ThirdPartySurveyActivity.this);

                    sign_in.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View view) {

                            if (email_thirdParty.getText().length() != 0 || password_thirdParty.getText().length() != 0) {
                                progressDialog.setMessage("Please Wait, Logging in...");
                                progressDialog.show();

                                request2 = new StringRequest(Request.Method.POST, URL2, new Response.Listener<String>() {
                                    @Override
                                    public void onResponse(String response) {
                                        try {
                                            progressDialog.dismiss();
                                            JSONArray array1 = new JSONArray(response);
                                            JSONObject t_array1 = array1.getJSONObject(0);

                                            if (t_array1.get("email").equals(email_thirdParty.getText().toString()) || t_array1.get("password").equals(password_thirdParty.getText().toString())) {

                                                thirdParty.add(t_array1.get("user_id").toString());//stores id of the user
                                                thirdParty.add(t_array1.get("username").toString());//stores name of the user
                                                Intent intent = new Intent(getApplicationContext(), ThirdPartyHomeActivity.class);
                                                intent.putExtra("username", email_thirdParty.getText().toString());
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
                                        HashMap<String, String> hashMap1 = new HashMap<String, String>();
                                        hashMap1.put("email", email_thirdParty.getText().toString());
                                        hashMap1.put("password", password_thirdParty.getText().toString());
                                        return hashMap1;
                                    }
                                };

                                requestQueue2.add(request2);
                            } else
                                Toast.makeText(ThirdPartySurveyActivity.this,"Please Fill the Above Fields to Login!",Toast.LENGTH_SHORT).show();

                        }
                    });
                }
                else {
                    AlertDialog.Builder alert = new AlertDialog.Builder(ThirdPartySurveyActivity.this);
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
        //Toast.makeText(ThirdPartySurveyActivity.this,"Third Party Survey Activity",Toast.LENGTH_SHORT).show();



    }
}