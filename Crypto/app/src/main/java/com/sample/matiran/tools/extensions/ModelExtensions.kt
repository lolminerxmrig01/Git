package com.sample.matiran.tools.extensions

import com.sample.matiran.model.Crypto
import com.sample.matiran.tools.network.entity.CryptoEntity
import com.sample.matiran.tools.network.entity.CryptoListResponseEntity

/*
    every field must be nullable
            default value for is = -1
            default value for price = 0.0
 */

fun CryptoListResponseEntity.toCryptoList(
    cryptoListMapper: Mapper<CryptoEntity, Crypto>
) = cryptoList?.map(cryptoListMapper) ?: listOf()
