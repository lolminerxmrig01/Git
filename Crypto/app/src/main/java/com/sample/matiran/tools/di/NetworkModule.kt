package com.sample.matiran.tools.di

import com.google.gson.GsonBuilder
import com.sample.matiran.tools.network.api.CryptoApi
import dagger.Module
import dagger.Provides
import dagger.hilt.InstallIn
import dagger.hilt.components.SingletonComponent
import okhttp3.Interceptor
import okhttp3.OkHttpClient
import okhttp3.logging.HttpLoggingInterceptor
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import java.util.concurrent.TimeUnit
import javax.inject.Singleton

@Module
@InstallIn(SingletonComponent::class)
object NetworkModule {

    @Provides
    @Singleton
    fun provideRetrofit(): Retrofit {

        val client = OkHttpClient.Builder()
        client.interceptors().add(
            Interceptor { chain ->
                val request = chain.request()
                val requestBuilder = request.newBuilder()
                    .method(request.method(), request.body())
                chain.proceed(requestBuilder.build())
            }
        )

        client.readTimeout(30, TimeUnit.SECONDS)
        //log request and response
        val logging = HttpLoggingInterceptor()
        logging.level = HttpLoggingInterceptor.Level.BODY
        client.addInterceptor(logging)

        val gson = GsonBuilder()
            .setLenient()
            .create()

        return Retrofit.Builder()
            .baseUrl("https://www.megaweb.ir/")
            .addConverterFactory(GsonConverterFactory.create(gson))
            .client(client.build())
            .build()
    }

//    @Singleton
//    @Provides
//    fun provideSharedHeaders(): Headers {
//        return Headers.Builder()
//            .add("ApiKey", "value")
//            .build()
//    }

    @Provides
    @Singleton
    fun provideCustomerApi(retrofit: Retrofit): CryptoApi =
        retrofit.create(CryptoApi::class.java)
}