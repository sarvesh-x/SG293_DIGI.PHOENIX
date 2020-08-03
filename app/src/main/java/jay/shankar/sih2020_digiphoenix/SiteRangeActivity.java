package jay.shankar.sih2020_digiphoenix;

import androidx.appcompat.app.AlertDialog;
import androidx.core.app.ActivityCompat;
import androidx.fragment.app.FragmentActivity;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.location.Location;
import android.os.Bundle;
import android.view.WindowManager;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.Circle;
import com.google.android.gms.maps.model.CircleOptions;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;

import java.io.Serializable;

public class SiteRangeActivity extends FragmentActivity implements OnMapReadyCallback {

    boolean INRANGE;
    private Serializable escolas;
    private ProgressDialog dialog;
    private Circle mCircle;
    private Marker mMarker;
    private GoogleMap mMap;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_site_range);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        if (mapFragment != null) {
            mapFragment.getMapAsync(this);
        }
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        double mLatitude =HomeActivity.lat;
        double mLongitude = HomeActivity.lon;

        // Add a marker in Sydney and move the camera
        LatLng tender = new LatLng(HomeActivity.lat, HomeActivity.lon);
        googleMap.setMapType(GoogleMap.MAP_TYPE_NORMAL);

        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // TODO: Consider calling
            //    ActivityCompat#requestPermissions
            // here to request the missing permissions, and then overriding
            //   public void onRequestPermissionsResult(int requestCode, String[] permissions,
            //                                          int[] grantResults)
            // to handle the case where the user grants the permission. See the documentation
            // for ActivityCompat#requestPermissions for more details.
            return;
        }
        googleMap.moveCamera(CameraUpdateFactory.newLatLngZoom(new LatLng(mLatitude, mLongitude), 15));

        MarkerOptions options = new MarkerOptions();
        options.position(new LatLng(mLatitude, mLongitude));
        LatLng latLng = new LatLng(mLatitude, mLongitude);
        drawMarkerWithCircle(latLng);

        mMap.setMyLocationEnabled(true);
        mMap.getUiSettings().setZoomControlsEnabled(true);
        mMap.getUiSettings().setMyLocationButtonEnabled(true);
        mMap.getUiSettings().setCompassEnabled(true);
        mMap.getUiSettings().setRotateGesturesEnabled(true);
        mMap.getUiSettings().setZoomGesturesEnabled(true);
        mMap.addMarker(new MarkerOptions().position(tender).title(HomeActivity.TenderName));
        mMap.moveCamera(CameraUpdateFactory.newLatLng(tender));
        mMap.setOnMyLocationChangeListener(new GoogleMap.OnMyLocationChangeListener(){

            @Override
            public void onMyLocationChange(Location location) {
                float[] distance = new float[2];

                        /*
                        Location.distanceBetween( mMarker.getPosition().latitude, mMarker.getPosition().longitude,
                                mCircle.getCenter().latitude, mCircle.getCenter().longitude, distance);
                                */

                Location.distanceBetween( location.getLatitude(), location.getLongitude(),
                        mCircle.getCenter().latitude, mCircle.getCenter().longitude, distance);

                if( distance[0] > mCircle.getRadius()  ){
                    INRANGE = false;
                    AlertDialog.Builder alert = new AlertDialog.Builder(SiteRangeActivity.this);
                    alert.setTitle("Alert");
                    alert.setMessage("Currently You're present Outside the Site Area and will not be Allowed to Upload the Details of Today's Work.\n" +
                            "Please Be present in the Site Area while Uploading Details.");
                    alert.setPositiveButton("Okay", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            finish();
                            startActivity(new Intent(SiteRangeActivity.this,HomeActivity.class));
                        }
                    });
                    alert.setCancelable(false);
                    alert.create();
                    alert.show();

                    Toast.makeText(getBaseContext(), "You're Outside the Range of Construction Site", Toast.LENGTH_LONG).show();
                } else {
                    INRANGE = true;
                    Toast.makeText(getBaseContext(), "Inside the Range of Construction Site", Toast.LENGTH_LONG).show();
                }
            }
        });
        //drawCircle(new LatLng(HomeActivity.lat, HomeActivity.lon));
    }
    private void drawMarkerWithCircle(LatLng position){
        double radiusInMeters = HomeActivity.RANGE;
        int strokeColor = 0xffff0000; //red outline
        int shadeColor = 0x44ff0000; //opaque red fill

        CircleOptions circleOptions = new CircleOptions().center(position).radius(radiusInMeters).fillColor(shadeColor).strokeColor(strokeColor).strokeWidth(8);
        mCircle = mMap.addCircle(circleOptions);

        MarkerOptions markerOptions = new MarkerOptions().position(position);
        mMarker = mMap.addMarker(markerOptions);
    }

    public boolean isInRange(){
        return INRANGE;
    }

}