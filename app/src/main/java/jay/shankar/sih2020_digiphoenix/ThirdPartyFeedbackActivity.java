package jay.shankar.sih2020_digiphoenix;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
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


public class ThirdPartyFeedbackActivity extends AppCompatActivity {

    ProgressDialog progressDialog;
    private RequestQueue requestQueue;
    static String tender_id = null;
    private StringRequest request;
    private static final String URL = "http://gyanamonline.com/rhcms/sih_files/thirdpartyfeedback.php";
    String date = new SimpleDateFormat("dd-MM-yyyy", Locale.getDefault()).format(new Date());

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_third_party_feedback);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_SECURE, WindowManager.LayoutParams.FLAG_SECURE);
        final EditText tender_idText  = findViewById(R.id.thirdPartyFeedback_tenderID);
        final EditText thirdPartyFeedback = findViewById(R.id.thirdParty_feedback);
        requestQueue = Volley.newRequestQueue(this);
        progressDialog = new ProgressDialog(this);
        Button btn = findViewById(R.id.thirdPartyFeedback_NextBtn);

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            tender_idText.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
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
        tender_idText.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
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
        tender_idText.setLongClickable(false);
        tender_idText.setTextIsSelectable(false);
        thirdPartyFeedback.setCustomSelectionActionModeCallback(new ActionMode.Callback() {
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
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            thirdPartyFeedback.setCustomInsertionActionModeCallback(new ActionMode.Callback() {
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

        thirdPartyFeedback.setTextIsSelectable(false);
        thirdPartyFeedback.setLongClickable(false);
        btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                tender_id = tender_idText.getText().toString();
                String thirdPartyFeedbackText = thirdPartyFeedback.getText().toString();
                uploadfeedback(thirdPartyFeedbackText);
            }
        });

    }

    private void uploadfeedback(final String thirdPartyFeedbackText) {

        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String ServerResponse) {
                        progressDialog.dismiss();
                        //ts_id = ServerResponse;
                        //HomeActivity h = new HomeActivity();
                        Toast.makeText(ThirdPartyFeedbackActivity.this, ServerResponse, Toast.LENGTH_LONG).show();
                        Intent intent = new Intent(ThirdPartyFeedbackActivity.this, ThirdPartyImageUploadActivity.class);
                        startActivity(intent);
                        finish();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError volleyError) {
                        progressDialog.dismiss();
                        Toast.makeText(ThirdPartyFeedbackActivity.this, volleyError.toString(), Toast.LENGTH_LONG).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() {

                Map<String, String> params = new HashMap<String, String>();
                params.put("t_id", tender_id);
                params.put("date", date);
                params.put("feedback", thirdPartyFeedbackText);

                return params;
            }

        };

        RequestQueue requestQueue = Volley.newRequestQueue(ThirdPartyFeedbackActivity.this);
        requestQueue.add(stringRequest);

    }
}