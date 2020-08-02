package jay.shankar.sih2020_digiphoenix;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;
import jay.shankar.sih2020_digiphoenix.ImageUploadActivity;
import jay.shankar.sih2020_digiphoenix.LoginActivity;
import jay.shankar.sih2020_digiphoenix.R;

public class UpdateTodaysWorkActivity extends AppCompatActivity implements LocationListener {

    ProgressDialog progressDialog;
    private RequestQueue requestQueue,requestQueue1;
    Button camera_btn;
    LocationManager locationManager;
    private static final String URL = "http://gyanamonline.com/rhcms/sih_files/update_details.php";
    private static final String TS_ID_URL = "http://gyanamonline.com/rhcms/sih_files/get_ts_id.php";
    public static String ts_id = null;
    private StringRequest request,request1;
    String date = new SimpleDateFormat("dd-MM-yyyy", Locale.getDefault()).format(new Date()); // stores current date
    // @RequiresApi(api = Build.VERSION_CODES.KITKAT)


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
    protected void onCreate( Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_update_todays_work);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
        requestQueue = Volley.newRequestQueue(this);
        progressDialog = new ProgressDialog(this);
        final EditText t_id = (EditText) findViewById(R.id.update_tender_id);
        t_id.setText(LoginActivity.user.get(2));
        t_id.setEnabled(false);
        final EditText issue_date = (EditText) findViewById(R.id.update_date);
        issue_date.setText(date);
        issue_date.setEnabled(false);
        final EditText todays_work = (EditText) findViewById(R.id.update_todays_work);
        final EditText total_emp = (EditText) findViewById(R.id.update_total_emp);
        final EditText emp_present = (EditText) findViewById(R.id.update_present_emp);
        final EditText daily_wages = (EditText) findViewById(R.id.update_daily_wages);
        final EditText daily_exp = (EditText) findViewById(R.id.update_daily_exp);
        final EditText reason_late = (EditText) findViewById(R.id.update_reason_late);
        final EditText other = (EditText) findViewById(R.id.update_other);
        final EditText work_completed = (EditText) findViewById(R.id.update_work_completed);

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