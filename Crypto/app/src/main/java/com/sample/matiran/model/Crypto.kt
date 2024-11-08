package com.sample.matiran.model

import android.content.Context
import androidx.core.content.ContextCompat
import com.example.matiran.R

class Crypto(
    val id: String,
    val name: String,
    val nameId: String,
    val cSupply: String,
    val mSupply: String,
    val tSupply: String,
    val marketCapUsd: String,
    val percentChange1h: String,
    val percentChange24h: String,
    val percentChange7d: String,
    val priceBtc: String,
    private val _priceUsd: String,
      val _rank: String,
    val symbol: String,
    val volume24: String,
    val volume24a: Double
) {

    val rank = _rank
        get() = "$field#"

    val priceUsd = _priceUsd
        get() = "$field$"


    fun getTextColor(context: Context, text: String): Int {

        return if (text.toDouble() > 0)
            ContextCompat.getColor(context, R.color.green)
        else
            ContextCompat.getColor(context, R.color.red)

    }


}