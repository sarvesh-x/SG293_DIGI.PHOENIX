package jay.shankar.sih2020_digiphoenix;

import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.cardview.widget.CardView;
import androidx.core.app.ActivityCompat;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.navigation.ui.AppBarConfiguration;

import android.Manifest;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.util.Range;
import android.view.MenuItem;
import android.view.View;
import android.view.WindowManager;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.material.navigation.NavigationView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class HomeActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener, LocationListener{

    private AppBarConfiguration mAppBarConfiguration;
    private CardView show_tender_details, update_tender_details, budget_req, work_stats, contact_authority, current_progress, notifications, help_and_support;
    public String ts_id;
    LocationManager locationManager;
    private static final String LOCATION_URL = "http://gyanamonline.com/rhcms/sih_files/tender_details.php";
    public static String TenderName;
    String VERIFIED = null;
    public static String lat_long = null;
    public static double lat,lon;
    public static Double RANGE;
    public String tender_id,tender_type,tender_name,tender_issue_date,tender_due_date,tender_budget,tender_details,tender_exp_budget;


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
                        Toast.makeText(HomeActivity.this,"Enable it Manually to Upload Images",Toast.LENGTH_SHORT).show();
                        dialog.cancel();
                    }
                });
        final AlertDialog alert = builder.create();
        alert.show();
    }

    private void isVerified(){
        StringRequest stringRequest = new StringRequest(Request.Method.POST, LOCATION_URL,
                new Response.Listener<String>() {
                    // @SuppressLint("SetTextI18n")
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONArray array = new JSONArray(response);
                            JSONObject t_details_current = array.getJSONObject(0);
                            VERIFIED = t_details_current.get("vp").toString();
                            lat_long = t_details_current.get("lat_long").toString();
                            TenderName = t_details_current.get("t_name").toString();
                            String[] latlong =  lat_long.split(",");
                            lat = Double.parseDouble(latlong[0]);
                            lon = Double.parseDouble(latlong[1]);
                            RANGE = Double.valueOf(t_details_current.get("r").toString());
                            if(VERIFIED.equals("No")){
                                startActivity(new Intent(HomeActivity.this,VerifyLocationActivity.class));
                                finish();
                            }else {
                                //Toast.makeText(HomeActivity.this,""+lat+"-"+lon,Toast.LENGTH_SHORT).show();
                            }

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

        Volley.newRequestQueue(HomeActivity.this).add(stringRequest);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        isVerified();

        getLocation();
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
        getLocationSite();
        //Toast.makeText(HomeActivity.this, ""+LoginActivity.user.get(2), Toast.LENGTH_SHORT).show();

        Toolbar toolbar = null;
        if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.LOLLIPOP) {
            toolbar = (Toolbar) findViewById(R.id.toolbar);
        }
        setSupportActionBar(toolbar);
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                HomeActivity.this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        findViewById(R.id.floatingActionButton).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
                drawer.openDrawer(GravityCompat.START);
            }
        });

        TextView welcome_text = (TextView)findViewById(R.id.home_username);
        welcome_text.setText(LoginActivity.user.get(0).toUpperCase().toString());
        welcome_text.setVisibility(View.VISIBLE);

        show_tender_details = (CardView) findViewById(R.id.home_tender_details);
        update_tender_details = (CardView) findViewById(R.id.home_upload_todays_work);
        budget_req = (CardView) findViewById(R.id.home_budget_requests);
        work_stats = (CardView) findViewById(R.id.home_overall_statistics);
        contact_authority = (CardView) findViewById(R.id.home_contact_authority);
        current_progress = (CardView) findViewById(R.id.home_current_progress);
        notifications = (CardView) findViewById(R.id.home_notifications);
        help_and_support = (CardView) findViewById(R.id.home_help_and_support);
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(HomeActivity.this);

        show_tender_details.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(HomeActivity.this,TenderDetailsActivity.class));
            }
        });

        update_tender_details.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                startActivity(new Intent(HomeActivity.this,UpdateTodaysWorkActivity.class));

            }
        });
        budget_req.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

            }
        });
        work_stats.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

            }
        });
        contact_authority.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(HomeActivity.this,RTCActivity.class));
            }
        });
        notifications.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(HomeActivity.this,NotificationActivity.class));
            }
        });
        help_and_support.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(HomeActivity.this,HelpandSupportActivity.class));

            }
        });
        current_progress.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(HomeActivity.this, SiteRangeActivity.class));
            }
        });
    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.nav_account) {

            Toast.makeText(HomeActivity.this, "Account Settings Here", Toast.LENGTH_SHORT).show();
        } else if (id == R.id.nav_settings) {

            Toast.makeText(HomeActivity.this, "Settings Here", Toast.LENGTH_SHORT).show();

        } else if (id == R.id.nav_about) {
            AlertDialog.Builder alert = new AlertDialog.Builder(HomeActivity.this);
            alert.setTitle("About");
           // alert.setMessage(R.string.dialog_message);
            alert.setPositiveButton("Okay", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialog, int which) {
                    dialog.cancel();
                }
            });
            alert.create();
            alert.show();
        } else if (id == R.id.nav_exit) {
            finish();
        }
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }


    public void getLocationSite(){
        StringRequest stringRequest = new StringRequest(Request.Method.POST, LOCATION_URL,
                new Response.Listener<String>() {
                    // @SuppressLint("SetTextI18n")
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONArray array = new JSONArray(response);
                            JSONObject t_details_current = array.getJSONObject(0);
                            lat_long = t_details_current.get("lat_long").toString();

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

        Volley.newRequestQueue(HomeActivity.this).add(stringRequest);
    }

    @Override
    public void onLocationChanged(Location location) {
        lat = location.getLatitude();
        lon = location.getLongitude();
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