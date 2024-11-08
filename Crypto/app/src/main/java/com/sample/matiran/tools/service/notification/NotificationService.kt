package com.sample.matiran.tools.service.notification

import android.annotation.SuppressLint
import android.widget.Toast
import com.sample.matiran.application.AppApplication

@SuppressLint("StaticFieldLeak")
object NotificationService {

    //todo change to activityContext
    private val context = AppApplication.context

    fun showInformation(message: String) {
        Toast.makeText(context, message, Toast.LENGTH_SHORT).show()
    }

    fun showError(message: String) {
        showInformation(message)
    }

    fun showError(messageId: Int) {
        showInformation(context.getString(messageId))
    }

    fun showLongInformation(message: String) {
        Toast.makeText(context, message, Toast.LENGTH_LONG).show()
    }
}