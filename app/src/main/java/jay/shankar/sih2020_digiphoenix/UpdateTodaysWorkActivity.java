package jay.shankar.sih2020_digiphoenix;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import android.Manifest;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Build;
import android.os.Bundle;
import android.view.ActionMode;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;

public class UpdateTodaysWorkActivity extends AppCompatActivity implements LocationListener{



    double current_lat,current_lon;
    LocationManager locationManager;
    ProgressDialog progressDialog;
    private RequestQueue requestQueue,requestQueue1;
    Button camera_btn;
    private static final String URL = "http://gyanamonline.com/rhcms/sih_files/update_details.php";
    //private static final String TS_ID_URL = "http://gyanamonline.com/rhcms/sih_files/get_ts_id.php";
    //public static String ts_id = null;
    private StringRequest request,request1;
    String date = new SimpleDateFormat("dd-MM-yyyy", Locale.getDefault()).format(new Date()); // stores current date

    @RequiresApi(api = Build.VERSION_CODES.M)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_update_todays_work);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
        String[] lat_lon = HomeActivity.lat_long.split(",");
        double lat = Double.parseDouble(lat_lon[0]);
        double lon = Double.parseDouble(lat_lon[1]);

        //Toast.makeText(UpdateTodaysWorkActivity.this,""+lat+","+lon,Toast.LENGTH_SHORT).show();
        getLocation();

        float[] dist = new float[5];
        Location.distanceBetween(lat,lon,current_lat,current_lon,dist);

        if(dist[0]/1000 > 1){
            Toast.makeText(UpdateTodaysWorkActivity.this,"Outside Range",Toast.LENGTH_SHORT).show();
        } else {
            Toast.makeText(UpdateTodaysWorkActivity.this, "Inside Range", Toast.LENGTH_SHORT).show();

            final EditText t_id = (EditText) findViewById(R.id.update_tender_id);
            t_id.setText(LoginActivity.user.get(2));
            t_id.setEnabled(false);
            final EditText issue_date = (EditText) findViewById(R.id.update_date);
            issue_date.setText(date);
            issue_date.setEnabled(false);
            final EditText todays_work = (EditText) findViewById(R.id.update_todays_work);
            todays_work.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
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
            todays_work.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
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
            todays_work.setLongClickable(false);
            todays_work.setTextIsSelectable(false);
            final EditText total_emp = (EditText) findViewById(R.id.update_total_emp);
            total_emp.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
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
            total_emp.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
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
            total_emp.setLongClickable(false);
            total_emp.setTextIsSelectable(false);
            final EditText emp_present = (EditText) findViewById(R.id.update_present_emp);
            emp_present.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
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
            emp_present.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
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
            emp_present.setLongClickable(false);
            emp_present.setTextIsSelectable(false);
            final EditText daily_wages = (EditText) findViewById(R.id.update_daily_wages);
            daily_wages.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
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
            daily_wages.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
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
            daily_wages.setLongClickable(false);
            daily_wages.setTextIsSelectable(false);
            final EditText daily_exp = (EditText) findViewById(R.id.update_daily_exp);
            daily_exp.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
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
            daily_exp.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
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
            daily_exp.setLongClickable(false);
            daily_exp.setTextIsSelectable(false);
            final EditText reason_late = (EditText) findViewById(R.id.update_reason_late);
            reason_late.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
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
            reason_late.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
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
            reason_late.setLongClickable(false);
            reason_late.setTextIsSelectable(false);
            final EditText other = (EditText) findViewById(R.id.update_other);
            other.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
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
            other.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
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
            other.setLongClickable(false);
            other.setTextIsSelectable(false);
            final EditText work_completed = (EditText) findViewById(R.id.update_work_completed);
            work_completed.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
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
            work_completed.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
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
            work_completed.setLongClickable(false);
            work_completed.setTextIsSelectable(false);

            Button nextPage = (Button) findViewById(R.id.nextPage);
            nextPage.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    if (todays_work.getText().length()!= 0 || total_emp.getText().length() !=0 || emp_present.getText().length() != 0 || daily_exp.getText().length() !=0 || daily_wages.getText().length() != 0 || reason_late.getText().length() != 0 || other.getText().length() != 0) {
                        progressDialog.setMessage("Please Wait, Updating Details...");
                        progressDialog.show();

                        final String tender_id = t_id.getText().toString();
                        final String date_issued = issue_date.getText().toString();
                        final String today_work = todays_work.getText().toString();
                        final String total_employees = total_emp.getText().toString();
                        final String employees_present = emp_present.getText().toString();
                        final String daily__wages = daily_wages.getText().toString();
                        final String daily_expenses = daily_exp.getText().toString();
                        final String reson_late = reason_late.getText().toString();
                        final String other_remarks = other.getText().toString();
                        final String work_completed_text = work_completed.getText().toString();

                        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL,
                                new Response.Listener<String>() {
                                    @Override
                                    public void onResponse(String ServerResponse) {
                                        progressDialog.dismiss();
                                        Toast.makeText(UpdateTodaysWorkActivity.this, ServerResponse, Toast.LENGTH_SHORT).show();
                                        Intent intent = new Intent(UpdateTodaysWorkActivity.this, ImageUploadActivity.class);
                                        startActivity(intent);
                                        finish();
                                    }
                                },
                                new Response.ErrorListener() {
                                    @Override
                                    public void onErrorResponse(VolleyError volleyError) {
                                        progressDialog.dismiss();
                                        Toast.makeText(UpdateTodaysWorkActivity.this, volleyError.toString(), Toast.LENGTH_LONG).show();
                                    }
                                }) {
                            @Override
                            protected Map<String, String> getParams() {

                                Map<String, String> params = new HashMap<String, String>();
                                params.put("tender_id", tender_id);
                                params.put("date", date_issued);
                                params.put("todays_work", today_work);
                                params.put("total_emp", total_employees);
                                params.put("emp_present", employees_present);
                                params.put("daily_wages", daily__wages);
                                params.put("daily_exp", daily_expenses);
                                params.put("reason", reson_late);
                                params.put("other", other_remarks);
                                params.put("work_completed",work_completed_text);

                                return params;
                            }

                        };

                        RequestQueue requestQueue = Volley.newRequestQueue(UpdateTodaysWorkActivity.this);
                        requestQueue.add(stringRequest);

                    } else
                        Toast.makeText(UpdateTodaysWorkActivity.this,"Please Fill All of the Above Fields",Toast.LENGTH_SHORT).show();
                }
            });
        }
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
                        Toast.makeText(UpdateTodaysWorkActivity.this,"Enable it Manually to Upload Images",Toast.LENGTH_SHORT).show();
                        dialog.cancel();
                    }
                });
        final AlertDialog alert = builder.create();
        alert.show();
    }

    @Override
    public void onLocationChanged (Location location){
        current_lat = location.getLatitude();
        current_lon = location.getLongitude();

    }

    @Override
    public void onStatusChanged (String provider,int status, Bundle extras){

    }

    @Override
    public void onProviderEnabled (String provider){

    }

    @Override
    public void onProviderDisabled (String provider){

    }

}