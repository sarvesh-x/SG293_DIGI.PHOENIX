package jay.shankar.sih2020_digiphoenix.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

import jay.shankar.sih2020_digiphoenix.Models.Notification;
import jay.shankar.sih2020_digiphoenix.R;

public class NotificationAdapter extends BaseAdapter {
    private Context context; //context
    private ArrayList<Notification> items; //data source of the list adapter

    //public constructor
    public NotificationAdapter(Context context, ArrayList<Notification> items) {
        this.context = context;
        this.items = items;
    }

    @Override
    public int getCount() {
        return items.size(); //returns total of items in the list
    }

    @Override
    public Object getItem(int position) {
        return items.get(position); //returns list item at the specified position
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        // inflate the layout for each list row
        if (convertView == null) {
            convertView = LayoutInflater.from(context).
                    inflate(R.layout.custom_list_item, parent, false);
        }

        // get current item to be displayed
        Notification currentItem = (Notification) getItem(position);

        // get the TextView for item name and item description
        TextView textViewItemName = (TextView)
                convertView.findViewById(R.id.subject);
        TextView textViewItemDescription = (TextView)
                convertView.findViewById(R.id.message);

        //sets the text for item name and item description from the current item object
        textViewItemName.setText(currentItem.getsubject());
        textViewItemDescription.setText(currentItem.getmessage());

        // returns the view for the current row
        return convertView;
    }
}