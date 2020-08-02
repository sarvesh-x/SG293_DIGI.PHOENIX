package jay.shankar.sih2020_digiphoenix;

import android.Manifest;
import android.annotation.SuppressLint;
import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.provider.Settings;
import android.util.Base64;
import android.view.View;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.Toast;
import androidx.appcompat.app.AlertDialog;
import androidx.core.app.ActivityCompat;
import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
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
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.ByteArrayOutputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.nio.charset.StandardCharsets;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;
import javax.net.ssl.HttpsURLConnection;


public class ImageUploadActivity extends Activity implements LocationListener {

    String UPLOAD_URL = "http://gynamonline.com/rhcms/sih_files/fileUpload.php";
    ImageView img;
    Button btn,nextBtn;
    boolean check = true;
    Camera camera;
    Bitmap bitmap;
    LocationManager locationManager;
    String ImageName = "image_name";
    String ImagePath = "image_path";
    String lat_long;
    ProgressDialog progressDialog;
    Button Next_btn;
    int image_position = 0;
    private EditText editTxt;
    private ListView list;
    private ArrayAdapter<String> adapter;
    private ArrayList<String> arrayList;
    private static final String TS_ID_URL = "http://gyanamonline.com/rhcms/sih_files/get_ts_id.php";
    public static String ts_id = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_image_upload);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
        Next_btn = findViewById(R.id.ImageUploadNext_btn);
        Next_btn.setVisibility(View.GONE);
        arrayList = new ArrayList<String>();

        Tovuti.from(this).monitor(new Monitor.ConnectivityListener(){
            @Override
            public void onConnectivityChanged(int connectionType, boolean isConnected, boolean isFast){
                // TODO: Handle the connection...
                if(isConnected)
                {

                    btn = findViewById(R.id.addBtn);
                    list = (ListView) findViewById(R.id.Imagelist);

                    getLocation();

                    Next_btn.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View v) {
                            Intent intent = new Intent(ImageUploadActivity.this, InvoiceUploadActivity.class);
                            intent.putExtra("ts_id",ts_id);
                            startActivity(intent);
                            finish();
                        }
                    });

                    adapter = new ArrayAdapter<String>(getApplicationContext(), android.R.layout.simple_list_item_1, arrayList);
                    list.setAdapter(adapter);
                    list.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                        @Override
                        public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                            camera = new Camera.Builder()
                                    .resetToCorrectOrientation(true)
                                    .setTakePhotoRequestCode(1)
                                    .setDirectory("Pictures")
                                    .setName("IMG_" + System.currentTimeMillis())
                                    .setImageFormat(Camera.IMAGE_JPEG)
                                    .setCompression(50)
                                    .setImageHeight(400)
                                    .build(ImageUploadActivity.this);
                            try {
                                image_position = position;
                                camera.takePicture();
                            } catch (Exception e) {
                                e.printStackTrace();
                            }
                        }
                    });
                    btn.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View view) {
                            get_ts_id();
                            get_ts_id();
                            arrayList.add("Click here to Capture Image");
                            adapter.notifyDataSetChanged();
                        }
                    });
                }
                else {
                    AlertDialog.Builder alert = new AlertDialog.Builder(ImageUploadActivity.this);
                    alert.setTitle("Error");
                    alert.setMessage("Connect to Internet for Sending Statistical Usage of App and Development");
                    alert.setPositiveButton("Settings", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.P) {
                                startActivity(new Intent(Settings.ACTION_DATA_USAGE_SETTINGS));
                            }
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
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == Camera.REQUEST_TAKE_PHOTO) {
            bitmap = camera.getCameraBitmap();
            if (bitmap != null) {
                uploadImage();
                //img.setImageBitmap(bitmap);
                Next_btn.setVisibility(View.VISIBLE);
                Next_btn.isEnabled();
                Next_btn.setClickable(true);

            } else {
                Toast.makeText(this.getApplicationContext(), "Picture not taken!", Toast.LENGTH_SHORT).show();
            }
        }
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        camera.deleteImage();
    }

    public void uploadImage() {

        @SuppressLint("StaticFieldLeak")
        class AsyncTaskUploadClass extends AsyncTask<Void, Void, String> {
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                progressDialog = ProgressDialog.show(ImageUploadActivity.this, "Image is Uploading", "Please Wait", false, false);
            }

            @Override
            protected void onPostExecute(String string1) {
                super.onPostExecute(string1);
                progressDialog.dismiss();
                Toast.makeText(ImageUploadActivity.this, string1, Toast.LENGTH_LONG).show();
                arrayList.set(image_position,"Uploaded!");
                adapter.notifyDataSetChanged();
                Next_btn.setVisibility(View.VISIBLE);
                Next_btn.isEnabled();
                Next_btn.setClickable(true);

            }

            @Override
            protected String doInBackground(Void... params) {
                String date = new SimpleDateFormat("dd-MM-yyyy", Locale.getDefault()).format(new Date());
                String currentTime = new SimpleDateFormat("HH:mm:ss", Locale.getDefault()).format(new Date());
                ImageProcessClass imageProcessClass = new ImageProcessClass();
                HashMap<String, String> HashMapParams = new HashMap<String, String>();
                get_ts_id();
                HashMapParams.put("ts_id", ts_id);
                HashMapParams.put(ImageName, LoginActivity.user.get(0) + "_" + date + "_" + currentTime);
                HashMapParams.put(ImagePath, toBase64(bitmap));
                HashMapParams.put("lat_long", lat_long);
                return imageProcessClass.ImageHttpRequest(UPLOAD_URL, HashMapParams);
            }
        }
        AsyncTaskUploadClass AsyncTaskUploadClassOBJ = new AsyncTaskUploadClass();
        AsyncTaskUploadClassOBJ.execute();
    }

    public class ImageProcessClass {
        public String ImageHttpRequest(String requestURL, HashMap<String, String> PData) {
            StringBuilder stringBuilder = new StringBuilder();
            try {

                URL url;
                HttpURLConnection httpURLConnectionObject;
                OutputStream OutPutStream;
                BufferedWriter bufferedWriterObject;
                BufferedReader bufferedReaderObject;
                int RC;
                url = new URL(requestURL);
                httpURLConnectionObject = (HttpURLConnection) url.openConnection();
                httpURLConnectionObject.setReadTimeout(19000);
                httpURLConnectionObject.setConnectTimeout(19000);
                httpURLConnectionObject.setRequestMethod("POST");
                httpURLConnectionObject.setDoInput(true);
                httpURLConnectionObject.setDoOutput(true);
                OutPutStream = httpURLConnectionObject.getOutputStream();
                bufferedWriterObject = new BufferedWriter(new OutputStreamWriter(OutPutStream, StandardCharsets.UTF_8));
                bufferedWriterObject.write(bufferedWriterDataFN(PData));
                bufferedWriterObject.flush();
                bufferedWriterObject.close();
                OutPutStream.close();
                RC = httpURLConnectionObject.getResponseCode();
                if (RC == HttpsURLConnection.HTTP_OK) {
                    bufferedReaderObject = new BufferedReader(new InputStreamReader(httpURLConnectionObject.getInputStream()));
                    stringBuilder = new StringBuilder();
                    String RC2;
                    while ((RC2 = bufferedReaderObject.readLine()) != null) {
                        stringBuilder.append(RC2);
                    }
                }

            } catch (Exception e) {
                e.printStackTrace();
            }
            return stringBuilder.toString();
        }

        private String bufferedWriterDataFN(HashMap<String, String> HashMapParams) throws UnsupportedEncodingException {

            StringBuilder stringBuilderObject;
            stringBuilderObject = new StringBuilder();
            for (Map.Entry<String, String> KEY : HashMapParams.entrySet()) {
                if (check)
                    check = false;
                else
                    stringBuilderObject.append("&");
                stringBuilderObject.append(URLEncoder.encode(KEY.getKey(), "UTF-8"));
                stringBuilderObject.append("=");
                stringBuilderObject.append(URLEncoder.encode(KEY.getValue(), "UTF-8"));
            }
            return stringBuilderObject.toString();
        }

    }

    private StringRequest request1;
    private RequestQueue requestQueue1;

    public void get_ts_id(){

        request1 = new StringRequest(Request.Method.POST, TS_ID_URL, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {

                    JSONArray array = new JSONArray(response);
                    JSONObject t_array = array.getJSONObject(0);
                    ts_id = t_array.getString("ts_id");

                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                HashMap<String, String> hashMap = new HashMap<String, String>();
                String date = new SimpleDateFormat("dd-MM-yyyy", Locale.getDefault()).format(new Date()); // stores current date
                hashMap.put("t_id", LoginActivity.user.get(2).toString());
                return hashMap;
            }
        };
        requestQueue1 = Volley.newRequestQueue(ImageUploadActivity.this);
        requestQueue1.add(request1);
    }

    public String toBase64(Bitmap bitmap) {
        ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.PNG, 50, byteArrayOutputStream);
        byte[] byteArray = byteArrayOutputStream.toByteArray();
        return Base64.encodeToString(byteArray, Base64.DEFAULT);
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
                        Toast.makeText(ImageUploadActivity.this,"Enable it Manually to Upload Images",Toast.LENGTH_SHORT).show();
                        dialog.cancel();
                    }
                });
        final AlertDialog alert = builder.create();
        alert.show();
    }

    @Override
    public void onLocationChanged (Location location){
        double latitude = location.getLatitude();
        double longitude = location.getLongitude();
        lat_long = String.valueOf(latitude)+","+String.valueOf(longitude);

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

